@extends('layouts.admin')

@section('title', 'View College')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 text-3xl font-medium">View College</h3>
        <div class="flex gap-2">
            <a href="{{ route('colleges.edit', $college) }}" class="px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-500">Edit</a>
            <a href="{{ route('colleges.index') }}" class="px-6 py-3 bg-gray-600 rounded-md text-white font-medium tracking-wide hover:bg-gray-500">Back to List</a>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- College Name -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">College Name</label>
                <p class="text-gray-900 text-lg">{{ $college->name }}</p>
            </div>

            <!-- College Code -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">College Code</label>
                <p class="text-gray-900 text-lg">{{ $college->code ?? '-' }}</p>
            </div>

            <!-- City -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">City</label>
                <p class="text-gray-900 text-lg">{{ $college->city ?? '-' }}</p>
            </div>

            <!-- State -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">State</label>
                <p class="text-gray-900 text-lg">{{ $college->state ?? '-' }}</p>
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <p class="text-gray-900 text-lg">{{ $college->phone ?? '-' }}</p>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <p class="text-gray-900 text-lg">
                    @if($college->email)
                        <a href="mailto:{{ $college->email }}" class="text-blue-600 hover:text-blue-900">{{ $college->email }}</a>
                    @else
                        -
                    @endif
                </p>
            </div>

            <!-- Principal Name -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Principal Name</label>
                <p class="text-gray-900 text-lg">{{ $college->principal_name ?? '-' }}</p>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                @if($college->status == 'active')
                    <span class="px-3 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="px-3 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Inactive
                    </span>
                @endif
            </div>

            <!-- Address -->
            <div class="col-span-1 md:col-span-2 mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <p class="text-gray-900 text-lg">{{ $college->address ?? '-' }}</p>
            </div>

            <!-- Created Date -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Created Date</label>
                <p class="text-gray-900 text-lg">{{ $college->created_at->format('d M Y H:i A') }}</p>
            </div>

            <!-- Updated Date -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Last Updated</label>
                <p class="text-gray-900 text-lg">{{ $college->updated_at->format('d M Y H:i A') }}</p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <form action="{{ route('colleges.destroy', $college) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this college? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Delete College
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
