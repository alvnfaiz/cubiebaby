<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\Message;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    //

    public function index(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $reports = $this->getProductLast30DaysOrder();
        $startDate = date('Y-m-d', strtotime('-30 days'));
        $endDate = date('Y-m-d');
        return view('Admin.report.index', compact( 'message', 'inbox', 'reports', 'startDate', 'endDate'));
    }

    public function createPDF(Request $requets) {
        // retreive all records from db
        if($requets->start){
            $reports = $this->getReportDay($requets->start, $requets->end);
            $start = $requets->start;
            $end = $requets->end;

        }else{
            $reports = $this->getProductLast30DaysOrder();
            $start = date('Y-m-d', strtotime('-30 days'));
            $end = date('Y-m-d');
        }
        $tanggal = $start.' s/d '.$end;
        //view()->share('data',$data);
        $pdf = PDF::loadView('pdf-view', compact('reports', 'tanggal'));
        // download PDF file with download method
        return \view('pdf-view', compact('reports', 'tanggal'));
        return $pdf->download('pdf_file.pdf');
      }

    public function member(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $reports = $this->getUserLast30DaysOrder();
        // dd($reports);
        return view('Admin.report.member', compact( 'message', 'inbox', 'reports'));
    }

    public function sale(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $reports = $this->getProductLast30DaysOrder();
        // dd($reports);
        return view('Admin.report.sale', compact( 'message', 'inbox', 'reports'));
    }


    public function create(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.report.create', compact( 'message', 'inbox'));
    }

    protected function getUserLast30DaysOrder(){
        $Users = User::whereHas('order', function($query){
            $query->where('created_at', '>=', now()->subDays(30));
        })->get();
        $total = 0;
        foreach($Users as $i=>$user){
            $data = Order::where('user_id', $user->id)->where('created_at', '>=', now()->subDays(30));
            $Users[$i]['total_order'] = $data->count();
            $Users[$i]['total_price'] = $data->sum('total_price');
            $Users[$i]['login'] = UserActivity::where('user_id', $user->id)->first();
            $total += $Users[$i]['total_order'];
        }
        $return = [
            'total' => $total,
            'users' => $Users
        ];
        return $return;
    }

    protected function getProductLast30DaysOrder(){
        $Products = Product::whereHas('order_detail', 
        function($query){
            $query->whereHas('order', 
                function($query){
                    $query->where('created_at', '>=', now()->subDays(30))->where('status_payment', 'Lunas');
            });
        })->get();
        $total = 0;
        foreach($Products as $i=>$product){
            $data = Order::whereHas('order_detail', function($query) use ($product){
                $query->where('product_id', $product->id);
                })->where('created_at', '>=', now()->subDays(30))->where('status_payment', 'Lunas');
            //banyak order

            $Products[$i]['total_order'] = OrderDetail::where('product_id', $product->id)->sum('total');
            $Products[$i]['total_price'] = $data->sum('total_price');
            $total += $Products[$i]['total_order'];
        }
        $return = [
            'total' => $total,
            'products' => $Products
        ];
        return $return;
    }

    public function indexAdmin(){

        $message = $this->getMessageCount();
        $inbox = $this->getInboxCount();
        $reports = $this->getProductLast30DaysOrder();
        return view('Admin.report.index', compact( 'message', 'inbox', 'reports'));
    }

    public function replyReport(Request $request){
        $request->validate([
            'reply' => 'required',
        ]);

        $report = Report::where('id', $request->id)->first();
        $report->reply = $request->reply;
        $report->save();

        return redirect()->route('admin.report.index');
    }

    public function getReport(Request $request){
        $startDate = $request->start;
        $endDate = $request->end;
        $reports = $this->getReportDay($startDate, $endDate);
        $message = $this->getMessageCount();
        $inbox = $this->getInboxCount();

        return view('Admin.report.index', compact('reports', 'message', 'inbox', 'startDate', 'endDate'));
    }

    public function getReportDay($startDate, $endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $Products = Product::whereHas('order_detail', function($query){
            $query->whereHas('order', function($query){
                $query->whereBetween('created_at',[$this->startDate, $this->endDate])->where('status_payment', 'Lunas');
            });
        })->get();
        $total = 0;
        foreach($Products as $i=>$product){
            $data = Order::whereHas('order_detail', function($query) use ($product){
                $query->where('product_id', $product->id);
                })->whereBetween('created_at',[$startDate, $endDate])->where('status_payment', 'Lunas');
            //banyak order

            $Products[$i]['total_order'] = OrderDetail::where('product_id', $product->id)->sum('total');
            $Products[$i]['total_price'] = $data->sum('total_price');
            $total += $Products[$i]['total_order'];
        }
        
        $reports['total'] = $total;
        $reports['products'] = $Products;
        return $reports;
    }

    public function getMessageCount()
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }

    protected function getInboxCount()
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }
}
