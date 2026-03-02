@extends('layouts.admin')

@section('title', 'Add New Student')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium">Add New Student</h3>
    
    <div class="mt-8">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" autocomplete="off">
            @csrf
            
            @if(isset($lead))
                <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Converting Lead:</strong>
                    <span class="block sm:inline">{{ $lead->name }} ({{ $lead->status }})</span>
                </div>
            @endif

            <!-- Personal Details -->
            <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Personal Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" type="text" name="name" value="{{ old('name', $lead->name ?? '') }}" placeholder="John Doe">
                    @error('name') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Roll Number -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="roll_number">
                        Roll Number <span class="text-gray-400 text-xs font-normal">(Leave blank to auto-generate)</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('roll_number') border-red-500 @enderror" id="roll_number" type="text" name="roll_number" value="{{ old('roll_number') }}" placeholder="e.g. STU-2026-0001">
                    @error('roll_number') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email" type="email" name="email" value="{{ old('email', $lead->email ?? '') }}" placeholder="john@example.com">
                    @error('email') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Mobile -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                        Mobile Number <span class="text-red-500">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('mobile') border-red-500 @enderror" id="mobile" type="text" name="mobile" value="{{ old('mobile', $lead->phone ?? '') }}" placeholder="1234567890">
                    @error('mobile') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Photo -->
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
                        Photo
                    </label>
                    <input class="w-full text-gray-700 px-3 py-2 border rounded" id="photo" type="file" name="photo">
                    @error('photo') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" id="status" name="status" onchange="calculateFinalFee()">
                        <option value="admission_done" {{ old('status') == 'admission_done' ? 'selected' : '' }}>Admission Done</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="placed" {{ old('status') == 'placed' ? 'selected' : '' }}>Placed</option>
                        <option value="dropped" {{ old('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Address Details -->
            <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Address Details</h4>

            <!-- Current Address -->
            <div class="mb-6">
                <h5 class="text-md font-bold text-gray-700 mb-3">Current Address</h5>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="current_address">
                        Address Line
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_address') border-red-500 @enderror" id="current_address" name="current_address" rows="2" placeholder="House No, Street, Landmark...">{{ old('current_address', $lead->current_address ?? '') }}</textarea>
                    @error('current_address') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="current_city">
                            City
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_city') border-red-500 @enderror" id="current_city" type="text" name="current_city" value="{{ old('current_city', $lead->current_city ?? '') }}" placeholder="e.g. Bangalore">
                        @error('current_city') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="current_state">
                            State
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_state') border-red-500 @enderror" id="current_state" type="text" name="current_state" value="{{ old('current_state', $lead->current_state ?? '') }}" placeholder="e.g. Karnataka">
                        @error('current_state') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="current_pincode">
                            Pincode
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_pincode') border-red-500 @enderror" id="current_pincode" type="text" name="current_pincode" value="{{ old('current_pincode', $lead->current_pincode ?? '') }}" placeholder="560001">
                        @error('current_pincode') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Permanent Address -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="text-md font-bold text-gray-700">Permanent Address</h5>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="same_as_current" class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition" onclick="copyAddress()">
                        <span class="ml-2 text-sm text-gray-600 font-bold">Same as Current</span>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="permanent_address">
                        Address Line
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('permanent_address') border-red-500 @enderror" id="permanent_address" name="permanent_address" rows="2" placeholder="House No, Street, Landmark...">{{ old('permanent_address', $lead->permanent_address ?? '') }}</textarea>
                    @error('permanent_address') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="permanent_city">
                            City
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('permanent_city') border-red-500 @enderror" id="permanent_city" type="text" name="permanent_city" value="{{ old('permanent_city', $lead->permanent_city ?? '') }}" placeholder="e.g. Bangalore">
                        @error('permanent_city') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="permanent_state">
                            State
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('permanent_state') border-red-500 @enderror" id="permanent_state" type="text" name="permanent_state" value="{{ old('permanent_state', $lead->permanent_state ?? '') }}" placeholder="e.g. Karnataka">
                        @error('permanent_state') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="permanent_pincode">
                            Pincode
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('permanent_pincode') border-red-500 @enderror" id="permanent_pincode" type="text" name="permanent_pincode" value="{{ old('permanent_pincode', $lead->permanent_pincode ?? '') }}" placeholder="560001">
                        @error('permanent_pincode') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Academic Details -->
            <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Academic Details</h4>
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Branch -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="branch_id">
                            Branch <span class="text-red-500">*</span>
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('branch_id') border-red-500 @enderror" id="branch_id" name="branch_id">
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $lead->preferred_branch_id ?? '') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Course -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="course_id">
                            Course <span class="text-red-500">*</span>
                        </label>
                        <select onchange="filterBatches(); fetchCourseFee()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('course_id') border-red-500 @enderror" id="course_id" name="course_id">
                            <option value="">Select Course</option>
                            @php
                                $leadFirstCourse = isset($lead) && !empty($lead->interested_courses) ? ($lead->interested_courses[0] ?? null) : null;
                            @endphp
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" data-fee="{{ $course->total_fee ?? 0 }}" {{ (old('course_id') == $course->id) || ($leadFirstCourse && $course->name == $leadFirstCourse) ? 'selected' : '' }}>{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Batch -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="batch_id">
                            Batch <span class="text-red-500">*</span>
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('batch_id') border-red-500 @enderror" id="batch_id" name="batch_id">
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" data-course-id="{{ $batch->course_id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }} ({{ $batch->status }})</option>
                            @endforeach
                        </select>
                        @error('batch_id') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Highest Qualification -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="highest_qualification">
                            Highest Qualification
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('highest_qualification') border-red-500 @enderror" id="highest_qualification" type="text" name="highest_qualification" value="{{ old('highest_qualification', $lead->highest_qualification ?? '') }}" placeholder="B.Tech, MCA...">
                        @error('highest_qualification') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- College Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="college_name">
                             College Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('college_name') border-red-500 @enderror" id="college_name" type="text" name="college_name" value="{{ old('college_name', $lead->college_name ?? '') }}" placeholder="University Name">
                        @error('college_name') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Percentage -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="percentage">
                            Percentage / CGPA
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('percentage') border-red-500 @enderror" id="percentage" type="number" step="0.01" name="percentage" value="{{ old('percentage', $lead->percentage ?? '') }}" placeholder="85.5">
                        @error('percentage') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Fee Details -->
            <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Fee Details</h4>
            <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Tuition Fee -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tuition_fee">
                            Tuition Fee <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tuition_fee" type="number" step="0.01" name="tuition_fee" value="{{ old('tuition_fee', 0) }}" oninput="calculateTotalFee()" placeholder="0.00">
                    </div>

                    <!-- Admission Fee -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="admission_fee">
                            Admission Fee <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="admission_fee" type="number" step="0.01" name="admission_fee" value="{{ old('admission_fee', 0) }}" oninput="calculateTotalFee()" placeholder="0.00">
                    </div>

                    <!-- Exam Fee (Optional) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="exam_fee">
                            Exam Fee <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exam_fee" type="number" step="0.01" name="exam_fee" value="{{ old('exam_fee', 0) }}" oninput="calculateTotalFee()" placeholder="0.00">
                    </div>

                    <!-- Hostel Fee (Optional) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hostel_fee">
                            Hostel Fee <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hostel_fee" type="number" step="0.01" name="hostel_fee" value="{{ old('hostel_fee', 0) }}" oninput="calculateTotalFee()" placeholder="0.00">
                    </div>

                    <!-- Bus Fee (Optional) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="bus_fee">
                            Bus Fee <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bus_fee" type="number" step="0.01" name="bus_fee" value="{{ old('bus_fee', 0) }}" oninput="calculateTotalFee()" placeholder="0.00">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <!-- Total Fee (Mandatory) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="total_fee">
                            Total Fee <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 bg-gray-100 font-bold leading-tight focus:outline-none" id="total_fee" type="number" step="0.01" name="total_fee" value="{{ old('total_fee', 0) }}" readonly>
                    </div>

                    <!-- Discount -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="discount">
                            Discount
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="discount" type="number" step="0.01" name="discount" value="{{ old('discount', 0) }}" oninput="calculateFinalFee()" placeholder="0.00">
                    </div>

                    <!-- Final Fee (Payable Now) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="final_fee">
                            Final Fee (Payable) <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 bg-gray-100 font-bold leading-tight focus:outline-none" id="final_fee" type="number" step="0.01" name="final_fee" value="{{ old('final_fee', 0) }}" readonly>
                    </div>
                </div>

                <!-- Payment Type -->
                <div class="mb-4 mt-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_type">
                        Payment Type <span class="text-red-500">*</span>
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="payment_type" name="payment_type">
                        <option value="full" {{ old('payment_type') == 'full' ? 'selected' : '' }}>Full Payment</option>
                        <option value="installments" {{ old('payment_type') == 'installments' ? 'selected' : '' }}>Installments</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                    Notes
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
            </div>

            <!-- Parent Details -->
            <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Parent / Guardian Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                 <!-- Parent Type -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_type">
                        Relation Type <span class="text-red-500">*</span>
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('parent_type') border-red-500 @enderror" id="parent_type" name="parent_type">
                        <option value="Father" {{ old('parent_type', $lead->parent_type ?? '') == 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('parent_type', $lead->parent_type ?? '') == 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Guardian" {{ old('parent_type', $lead->parent_type ?? '') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                    </select>
                    @error('parent_type') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>

                 <!-- Parent Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_name">
                        Parent Name <span class="text-red-500">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('parent_name') border-red-500 @enderror" id="parent_name" type="text" name="parent_name" value="{{ old('parent_name', $lead->parent_name ?? '') }}">
                    @error('parent_name') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>
                
                 <!-- Parent Mobile -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_mobile">
                        Parent Mobile <span class="text-red-500">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('parent_mobile') border-red-500 @enderror" id="parent_mobile" type="text" name="parent_mobile" value="{{ old('parent_mobile', $lead->parent_mobile ?? '') }}">
                    @error('parent_mobile') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>
                
                <!-- Parent Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_email">
                        Parent Email (Optional)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('parent_email') border-red-500 @enderror" id="parent_email" type="email" name="parent_email" value="{{ old('parent_email', $lead->parent_email ?? '') }}">
                    @error('parent_email') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                <div class="flex space-x-4">
                    <button type="submit" name="save_and_new" value="1" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Save & Add Another
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Save Student
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function filterBatches() {
        var courseSelect = document.getElementById('course_id');
        var batchSelect = document.getElementById('batch_id');
        var selectedCourseId = courseSelect.value;
        
        var options = batchSelect.options;

        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            var courseId = option.getAttribute('data-course-id');
            
            if (option.value === "") continue; 

            if (selectedCourseId === "" || courseId === selectedCourseId) {
                option.style.display = "";
            } else {
                option.style.display = "none";
            }
        }
    }
    
    function calculateTotalFee() {
        const tuitionFee = parseFloat(document.getElementById('tuition_fee').value) || 0;
        const admissionFee = parseFloat(document.getElementById('admission_fee').value) || 0;
        const examFee = parseFloat(document.getElementById('exam_fee').value) || 0;
        const hostelFee = parseFloat(document.getElementById('hostel_fee').value) || 0;
        const busFee = parseFloat(document.getElementById('bus_fee').value) || 0;

        const totalFee = tuitionFee + admissionFee + examFee + hostelFee + busFee;
        document.getElementById('total_fee').value = totalFee.toFixed(2);

        calculateFinalFee();
    }

    function calculateFinalFee() {
        const totalFee = parseFloat(document.getElementById('total_fee').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;

        const finalFee = totalFee - discount;
        document.getElementById('final_fee').value = (finalFee < 0 ? 0 : finalFee).toFixed(2);
    }

    function copyAddress() {
        const fields = ['address', 'city', 'state', 'pincode'];
        const isChecked = document.getElementById('same_as_current').checked;
        
        fields.forEach(field => {
            const currentVal = document.getElementById('current_' + field).value;
            const permField = document.getElementById('permanent_' + field);
            if (isChecked) {
                permField.value = currentVal;
            } else {
                permField.value = '';
            }
        });
    }

    // Run on load to correct batch visibility and calculate fees
    document.addEventListener('DOMContentLoaded', function() {
        filterBatches();
        calculateTotalFee();
    });
</script>
@endsection
