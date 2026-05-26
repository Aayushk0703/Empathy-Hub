<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Services\AdminActivityLogger;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::query()
            ->with(['user', 'product'])
            ->latest('id')
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::query()->orderBy('name')->limit(500)->get();
        $products = Product::query()->orderBy('name')->limit(500)->get();
        return view('admin.payments.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        if ($data['status'] === 'paid' && empty($data['paid_at'])) {
            $data['paid_at'] = now();
        }

        $payment = Payment::create($data);
        AdminActivityLogger::log(
            $request->user(),
            'payments',
            'create',
            'Created payment #'.$payment->id,
            Payment::class,
            $payment->id,
            ['status' => $payment->status, 'amount' => $payment->amount],
            $request
        );
        return redirect()->route('admin.payments.index')->with('success', 'Payment created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'product']);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $users = User::query()->orderBy('name')->limit(500)->get();
        $products = Product::query()->orderBy('name')->limit(500)->get();
        return view('admin.payments.edit', compact('payment', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $data = $request->validated();
        if ($data['status'] === 'paid' && empty($data['paid_at']) && $payment->paid_at === null) {
            $data['paid_at'] = now();
        }

        $payment->update($data);
        AdminActivityLogger::log(
            $request->user(),
            'payments',
            'update',
            'Updated payment #'.$payment->id,
            Payment::class,
            $payment->id,
            ['status' => $payment->status, 'amount' => $payment->amount],
            $request
        );
        return redirect()->route('admin.payments.index')->with('success', 'Payment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $id = $payment->id;
        $payment->delete();
        AdminActivityLogger::log(
            request()->user(),
            'payments',
            'delete',
            'Deleted payment #'.$id,
            Payment::class,
            $id,
            null,
            request()
        );
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted.');
    }
}
