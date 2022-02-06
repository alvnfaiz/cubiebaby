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

class ReportController extends Controller
{
    //

    public function index(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $reports = Report::paginate(20);
        return view('Admin.report.index', compact( 'message', 'inbox'));
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
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $reports = Report::paginate(20);
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
