@extends('layouts.admin')

@section('title', 'Payment Receipt')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center no-print">
        <h3 class="text-gray-700 text-3xl font-medium">Payment Receipt</h3>
        <div class="flex space-x-2">
            <a href="javascript:history.back()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Back</a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">🖨️ Print PDF</button>
        </div>
    </div>

    <!-- Receipt Card -->
    <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 max-w-2xl mx-auto p-8" id="receipt">
        <div class="text-center border-b border-gray-300 pb-6 mb-6">
            <h1 class="text-4xl font-bold text-gray-900">PAYMENT RECEIPT</h1>
            <p class="text-gray-600 mt-2">Student Management System</p>
        </div>

        <!-- Receipt Details -->
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p class="text-gray-600 text-xs uppercase tracking-widest font-bold">Student Information</p>
                <h4 class="text-xl font-bold text-gray-900 mt-1">{{ $payment->student->name }}</h4>
                <p class="text-gray-700 text-sm mt-1"><strong>Roll No:</strong> {{ $payment->student->roll_number }}</p>
                <p class="text-gray-700 text-sm"><strong>Mobile:</strong> {{ $payment->student->mobile }}</p>
                <p class="text-gray-700 text-sm"><strong>Email:</strong> {{ $payment->student->email }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600 text-xs uppercase tracking-widest font-bold">Receipt Details</p>
                <p class="text-gray-700 text-sm mt-1"><strong>Receipt #:</strong> {{ $payment->receipt_no ?? 'RCP-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p class="text-gray-700 text-sm"><strong>Date:</strong> {{ $payment->payment_date ? $payment->payment_date->format('d M Y') : $payment->created_at->format('d M Y') }}</p>
                <p class="text-gray-700 text-sm"><strong>Mode:</strong> {{ ucfirst($payment->payment_mode ?? 'N/A') }}</p>
            </div>
        </div>

        <!-- Payment Amount Section -->
        <div class="bg-indigo-50 border-2 border-indigo-400 rounded-lg p-4 mb-6">
            <div class="flex justify-between items-center">
                <span class="text-xl font-bold text-gray-900">Amount Paid:</span>
                <span class="text-4xl font-bold text-indigo-700">₹{{ number_format($payment->amount, 2) }}</span>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="mb-6">
            <table class="w-full text-sm">
                <tr class="border-b border-gray-300">
                    <td class="py-2 font-semibold text-gray-900">Transaction Reference:</td>
                    <td class="py-2 text-right text-gray-700">{{ $payment->transaction_ref ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 font-semibold text-gray-900">Payment Status:</td>
                    <td class="py-2 text-right">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">✓ Received</span>
                    </td>
                </tr>
                @if($payment->notes)
                <tr>
                    <td class="py-2 font-semibold text-gray-900">Notes:</td>
                    <td class="py-2 text-right text-gray-700">{{ $payment->notes }}</td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Fee Summary -->
        <div class="bg-gray-50 border border-gray-300 rounded-lg p-4 mb-6">
            <h3 class="font-bold text-gray-900 mb-3">Fee Summary</h3>
            <table class="w-full text-sm">
                <tr class="border-b border-gray-300">
                    <td class="py-2 text-gray-700">Total Fee Due:</td>
                    <td class="py-2 text-right font-semibold text-gray-900">₹{{ number_format($payment->student->final_fee, 2) }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 text-gray-700">This Payment:</td>
                    <td class="py-2 text-right font-semibold text-indigo-700">₹{{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-bold text-gray-900">Balance Due:</td>
                    <td class="py-2 text-right font-bold text-lg {{ ($payment->student->final_fee - ($payment->student->paid_amount ?? 0)) > 0 ? 'text-red-700' : 'text-green-700' }}">
                        ₹{{ number_format(max(0, $payment->student->final_fee - ($payment->student->paid_amount ?? 0)), 2) }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="text-center border-t border-gray-300 pt-6 mt-6 text-gray-600 text-xs">
            <p>This is a system-generated receipt. No signature required.</p>
            <p class="mt-2">For any queries, please contact the administration office.</p>
            <p class="mt-4 text-gray-500">Printed on {{ now()->format('d M Y H:i') }}</p>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background-color: white;
        }
        .no-print {
            display: none !important;
        }
        #receipt {
            box-shadow: none !important;
            page-break-after: always;
        }
    }
</style>
@endsection
