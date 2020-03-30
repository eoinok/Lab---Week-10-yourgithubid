<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateorderdetailRequest;
use App\Http\Requests\UpdateorderdetailRequest;
use App\Repositories\orderdetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class orderdetailController extends AppBaseController
{
    /** @var  orderdetailRepository */
    private $orderdetailRepository;

    public function __construct(orderdetailRepository $orderdetailRepo)
    {
        $this->orderdetailRepository = $orderdetailRepo;
    }

    /**
     * Display a listing of the orderdetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orderdetails = $this->orderdetailRepository->all();

        return view('orderdetails.index')
            ->with('orderdetails', $orderdetails);
    }

    /**
     * Show the form for creating a new orderdetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('orderdetails.create');
    }

    /**
     * Store a newly created orderdetail in storage.
     *
     * @param CreateorderdetailRequest $request
     *
     * @return Response
     */
    public function store(CreateorderdetailRequest $request)
    {
        $input = $request->all();

        $orderdetail = $this->orderdetailRepository->create($input);

        Flash::success('Orderdetail saved successfully.');

        return redirect(route('orderdetails.index'));
    }

    /**
     * Display the specified orderdetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderdetail = $this->orderdetailRepository->find($id);

        if (empty($orderdetail)) {
            Flash::error('Orderdetail not found');

            return redirect(route('orderdetails.index'));
        }

        return view('orderdetails.show')->with('orderdetail', $orderdetail);
    }

    /**
     * Show the form for editing the specified orderdetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderdetail = $this->orderdetailRepository->find($id);

        if (empty($orderdetail)) {
            Flash::error('Orderdetail not found');

            return redirect(route('orderdetails.index'));
        }

        return view('orderdetails.edit')->with('orderdetail', $orderdetail);
    }

    /**
     * Update the specified orderdetail in storage.
     *
     * @param int $id
     * @param UpdateorderdetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateorderdetailRequest $request)
    {
        $orderdetail = $this->orderdetailRepository->find($id);

        if (empty($orderdetail)) {
            Flash::error('Orderdetail not found');

            return redirect(route('orderdetails.index'));
        }

        $orderdetail = $this->orderdetailRepository->update($request->all(), $id);

        Flash::success('Orderdetail updated successfully.');

        return redirect(route('orderdetails.index'));
    }

    /**
     * Remove the specified orderdetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderdetail = $this->orderdetailRepository->find($id);

        if (empty($orderdetail)) {
            Flash::error('Orderdetail not found');

            return redirect(route('orderdetails.index'));
        }

        $this->orderdetailRepository->delete($id);

        Flash::success('Orderdetail deleted successfully.');

        return redirect(route('orderdetails.index'));
    }
}
