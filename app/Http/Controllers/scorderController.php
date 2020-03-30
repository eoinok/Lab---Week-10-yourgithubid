<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatescorderRequest;
use App\Http\Requests\UpdatescorderRequest;
use App\Repositories\scorderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Session;

class scorderController extends AppBaseController
{
    /** @var  scorderRepository */
    private $scorderRepository;

    public function __construct(scorderRepository $scorderRepo)
    {
        $this->scorderRepository = $scorderRepo;
    }

	public function checkout()
	{
		if (Session::has('cart')) {
			$cart = Session::get('cart');
			$lineitems = array();
			foreach ($cart as $productid => $qty) {
				$lineitem['product'] = \App\Models\Product::find($productid);
				$lineitem['qty'] = $qty;
				$lineitems[] = $lineitem;
			}
			return view('scorders.checkout')->with('lineitems', $lineitems);
		}
		else {
			Flash::error("There are no items in your cart");
			return redirect(route('products.displaygrid'));
		}
	}
	
	public function placeorder(Request $request)
	{
		$thisOrder = new \App\Models\Scorder();
		$thisOrder->orderdate = (new \DateTime())->format("Y-m-d H:i:s");
		$thisOrder->save();
		$orderID = $thisOrder->id;
		$productids = $request->productid;
		$quantities = $request->quantity;
		for($i=0;$i<sizeof($productids);$i++) {
			$thisOrderDetail = new \App\Models\OrderDetail();
			$thisOrderDetail->orderid = $orderID;
			$thisOrderDetail->productid = $productids[$i];
			$thisOrderDetail->quantity = $quantities[$i];
			$thisOrderDetail->save();
		}
		Session::forget('cart');
		Flash::success("Your Order has Been Placed");
		return redirect(route('products.displaygrid'));
	}
	
	
    /**
     * Display a listing of the scorder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $scorders = $this->scorderRepository->all();

        return view('scorders.index')
            ->with('scorders', $scorders);
    }

    /**
     * Show the form for creating a new scorder.
     *
     * @return Response
     */
    public function create()
    {
        return view('scorders.create');
    }

    /**
     * Store a newly created scorder in storage.
     *
     * @param CreatescorderRequest $request
     *
     * @return Response
     */
    public function store(CreatescorderRequest $request)
    {
        $input = $request->all();

        $scorder = $this->scorderRepository->create($input);

        Flash::success('Scorder saved successfully.');

        return redirect(route('scorders.index'));
    }

    /**
     * Display the specified scorder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $scorder = $this->scorderRepository->find($id);

        if (empty($scorder)) {
            Flash::error('Scorder not found');

            return redirect(route('scorders.index'));
        }

        return view('scorders.show')->with('scorder', $scorder);
    }

    /**
     * Show the form for editing the specified scorder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $scorder = $this->scorderRepository->find($id);

        if (empty($scorder)) {
            Flash::error('Scorder not found');

            return redirect(route('scorders.index'));
        }

        return view('scorders.edit')->with('scorder', $scorder);
    }

    /**
     * Update the specified scorder in storage.
     *
     * @param int $id
     * @param UpdatescorderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatescorderRequest $request)
    {
        $scorder = $this->scorderRepository->find($id);

        if (empty($scorder)) {
            Flash::error('Scorder not found');

            return redirect(route('scorders.index'));
        }

        $scorder = $this->scorderRepository->update($request->all(), $id);

        Flash::success('Scorder updated successfully.');

        return redirect(route('scorders.index'));
    }

    /**
     * Remove the specified scorder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $scorder = $this->scorderRepository->find($id);

        if (empty($scorder)) {
            Flash::error('Scorder not found');

            return redirect(route('scorders.index'));
        }

        $this->scorderRepository->delete($id);

        Flash::success('Scorder deleted successfully.');

        return redirect(route('scorders.index'));
    }
}
