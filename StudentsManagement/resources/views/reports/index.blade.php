@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="container mx-auto px-6 py-8">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h3 class="text-gray-700 text-3xl font-medium">Reports</h3>
            <p class="text-gray-500 mt-1">Select a report to view detailed analysis and exports.</p>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Fee Collection Report -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="h-3 bg-green-500"></div>
            <div class="p-8">
                <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Fee Collection</h4>
                <p class="text-gray-500 mb-8 leading-relaxed">Detailed report of all payments collected. Filter by date range, branch, or specific batch.</p>
                <a href="{{ route('reports.fee-collection') }}" class="inline-flex items-center px-6 py-3 bg-green-50 text-green-700 font-bold rounded-xl hover:bg-green-600 hover:text-white transition-all duration-300">
                    View Report
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Due Fees Report -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="h-3 bg-red-500"></div>
            <div class="p-8">
                <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Due Fees</h4>
                <p class="text-gray-500 mb-8 leading-relaxed">Monitor outstanding balances and pending fees. Identify students with critical payment delays.</p>
                <a href="{{ route('reports.due-report') }}" class="inline-flex items-center px-6 py-3 bg-red-50 text-red-700 font-bold rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300">
                    View Report
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Students Report -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="h-3 bg-indigo-500"></div>
            <div class="p-8">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Students</h4>
                <p class="text-gray-500 mb-8 leading-relaxed">View complete student information. Analyze students by batch, branch, and status.</p>
                <a href="{{ route('reports.index') }}#students" class="inline-flex items-center px-6 py-3 bg-indigo-50 text-indigo-700 font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
                    View Report
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Hidden Reports:
        - Attendance Report
        - Counsellor Performance
        - Source Matrix
        --}}

    </div>

    <!-- Students Report Section -->
    <div id="students" class="mt-16">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-gray-700 text-3xl font-medium">Students Report</h3>
                <p class="text-gray-500 mt-1">Complete list of all students with details.</p>
            </div>
            <div>
                <a href="{{ route('reports.export-students') }}" class="inline-flex items-center px-6 py-3 bg-blue-50 text-blue-700 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Export to CSV
                </a>
            </div>
        </div>

        <!-- Students Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Roll No</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Batch</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Branch</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Final Fee</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($studentsData ?? \App\Models\Student::with(['batch', 'branch'])->limit(50)->get() as $student)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $student->roll_number ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $student->first_name }} {{ $student->last_name ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $student->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $student->batch->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $student->branch->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-800">₹{{ number_format($student->final_fee ?? 0, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        @if($student->status === 'active') bg-green-100 text-green-700
                                        @elseif($student->status === 'inactive') bg-gray-100 text-gray-700
                                        @elseif($student->status === 'graduated') bg-blue-100 text-blue-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ ucfirst($student->status ?? 'N/A') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    No students found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Students</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $studentsCount ?? \App\Models\Student::count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 10H9M9 20h6m6-16H3v14a3 3 0 003 3h12a3 3 0 003-3V4z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Active Students</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $activeStudents ?? \App\Models\Student::where('status', 'active')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Graduated</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $graduatedStudents ?? \App\Models\Student::where('status', 'graduated')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Fees</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">₹{{ number_format($totalStudentFees ?? \App\Models\Student::sum('final_fee'), 2) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
