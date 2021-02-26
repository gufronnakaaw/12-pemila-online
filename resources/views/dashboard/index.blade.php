@extends('dashboard.master.app')
@section('title', 'Dashboard')
@section('page_heading', 'Dashboard')

@section('card')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Laptops</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_laptops'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Used Laptops</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['used_laptops'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unused Laptops</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $data['unused_laptops'] }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_users'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="table-responsive table-dashboard">
    <table class="table table-bordered text-center">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Class</th>
            <th>Majors</th>
            <th>Total</th>
            <th>Reason</th>
            <th>Laptops</th>
            <th>Action</th>
        </tr>
        
        @if($data['orders']->isNotEmpty())
        @foreach ($data['orders'] as $order)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $order->name_order }}</td>
              <td>{{ $order->class }}</td>
              <td>{{ $order->majors }}</td>
              <td>{{ $order->total }}</td>
              <td>{{ $order->reason }}</td>
              <td>{{ $order->laptops }}</td>
              <td>
                <button class="btn btn-info">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>
          </tr>
        @endforeach
        @else
        <tr>
          <td colspan="8" class="alert alert-danger text-center">Data Empty</td>
        </tr>
        @endif
    </table>
</div>
@endsection