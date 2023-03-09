@extends('layouts.verdant_admin')

@section('contents')
    <div class="container-fluid dashboardSummary">
        <div class="row">
            <div class="col-sm-12">
                <div class="titleWithDateDiv">
                    <div><h4>Overview</h4></div>
                    <div>
                        <h5 class="mb-1 text-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>
                            Filter Date
                        </h5>
                        <div class="reportRangePicker">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z"/><path d="M20 9.83984H4C3.45 9.83984 3 10.2898 3 10.8398V16.9998C3 19.9998 4.5 21.9998 8 21.9998H16C19.5 21.9998 21 19.9998 21 16.9998V10.8398C21 10.2898 20.55 9.83984 20 9.83984ZM9.21 18.2098C9.16 18.2498 9.11 18.2998 9.06 18.3298C9 18.3698 8.94 18.3998 8.88 18.4198C8.82 18.4498 8.76 18.4698 8.7 18.4798C8.63 18.4898 8.57 18.4998 8.5 18.4998C8.37 18.4998 8.24 18.4698 8.12 18.4198C7.99 18.3698 7.89 18.2998 7.79 18.2098C7.61 18.0198 7.5 17.7598 7.5 17.4998C7.5 17.2398 7.61 16.9798 7.79 16.7898C7.89 16.6998 7.99 16.6298 8.12 16.5798C8.3 16.4998 8.5 16.4798 8.7 16.5198C8.76 16.5298 8.82 16.5498 8.88 16.5798C8.94 16.5998 9 16.6298 9.06 16.6698C9.11 16.7098 9.16 16.7498 9.21 16.7898C9.39 16.9798 9.5 17.2398 9.5 17.4998C9.5 17.7598 9.39 18.0198 9.21 18.2098ZM9.21 14.7098C9.02 14.8898 8.76 14.9998 8.5 14.9998C8.24 14.9998 7.98 14.8898 7.79 14.7098C7.61 14.5198 7.5 14.2598 7.5 13.9998C7.5 13.7398 7.61 13.4798 7.79 13.2898C8.07 13.0098 8.51 12.9198 8.88 13.0798C9.01 13.1298 9.12 13.1998 9.21 13.2898C9.39 13.4798 9.5 13.7398 9.5 13.9998C9.5 14.2598 9.39 14.5198 9.21 14.7098ZM12.71 18.2098C12.52 18.3898 12.26 18.4998 12 18.4998C11.74 18.4998 11.48 18.3898 11.29 18.2098C11.11 18.0198 11 17.7598 11 17.4998C11 17.2398 11.11 16.9798 11.29 16.7898C11.66 16.4198 12.34 16.4198 12.71 16.7898C12.89 16.9798 13 17.2398 13 17.4998C13 17.7598 12.89 18.0198 12.71 18.2098ZM12.71 14.7098C12.66 14.7498 12.61 14.7898 12.56 14.8298C12.5 14.8698 12.44 14.8998 12.38 14.9198C12.32 14.9498 12.26 14.9698 12.2 14.9798C12.13 14.9898 12.07 14.9998 12 14.9998C11.74 14.9998 11.48 14.8898 11.29 14.7098C11.11 14.5198 11 14.2598 11 13.9998C11 13.7398 11.11 13.4798 11.29 13.2898C11.38 13.1998 11.49 13.1298 11.62 13.0798C11.99 12.9198 12.43 13.0098 12.71 13.2898C12.89 13.4798 13 13.7398 13 13.9998C13 14.2598 12.89 14.5198 12.71 14.7098ZM16.21 18.2098C16.02 18.3898 15.76 18.4998 15.5 18.4998C15.24 18.4998 14.98 18.3898 14.79 18.2098C14.61 18.0198 14.5 17.7598 14.5 17.4998C14.5 17.2398 14.61 16.9798 14.79 16.7898C15.16 16.4198 15.84 16.4198 16.21 16.7898C16.39 16.9798 16.5 17.2398 16.5 17.4998C16.5 17.7598 16.39 18.0198 16.21 18.2098ZM16.21 14.7098C16.16 14.7498 16.11 14.7898 16.06 14.8298C16 14.8698 15.94 14.8998 15.88 14.9198C15.82 14.9498 15.76 14.9698 15.7 14.9798C15.63 14.9898 15.56 14.9998 15.5 14.9998C15.24 14.9998 14.98 14.8898 14.79 14.7098C14.61 14.5198 14.5 14.2598 14.5 13.9998C14.5 13.7398 14.61 13.4798 14.79 13.2898C14.89 13.1998 14.99 13.1298 15.12 13.0798C15.3 12.9998 15.5 12.9798 15.7 13.0198C15.76 13.0298 15.82 13.0498 15.88 13.0798C15.94 13.0998 16 13.1298 16.06 13.1698C16.11 13.2098 16.16 13.2498 16.21 13.2898C16.39 13.4798 16.5 13.7398 16.5 13.9998C16.5 14.2598 16.39 14.5198 16.21 14.7098Z"/></svg>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('error_success_message')

        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Total Admin</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($account_total)}}</h2>
                        <span class="orange-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 2H6C4.34 2 3 3.33 3 4.97V15.88C3 17.52 4.34 18.86 6 18.86H6.76C7.55 18.86 8.32 19.17 8.88 19.73L10.59 21.42C11.37 22.19 12.63 22.19 13.41 21.42L15.12 19.73C15.68 19.17 16.45 18.86 17.24 18.86H18C19.66 18.86 21 17.52 21 15.88V4.97C21 3.33 19.66 2 18 2ZM12 5.55C13.08 5.55 13.95 6.43 13.95 7.5C13.95 8.56 13.11 9.41 12.07 9.45C12.03 9.45 11.97 9.45 11.92 9.45C10.87 9.41 10.04 8.56 10.04 7.5C10.05 6.43 10.92 5.55 12 5.55ZM14.75 14.69C13.24 15.7 10.76 15.7 9.25 14.69C7.92 13.81 7.92 12.35 9.25 11.46C10.77 10.45 13.25 10.45 14.75 11.46C16.08 12.35 16.08 13.8 14.75 14.69Z"/></svg>
                                </span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Active Admin</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($account_active)}}</h2>
                        <span class="green-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 2H6C4.34 2 3 3.33 3 4.97V15.88C3 17.52 4.34 18.86 6 18.86H6.76C7.55 18.86 8.32 19.17 8.88 19.73L10.59 21.42C11.37 22.19 12.63 22.19 13.41 21.42L15.12 19.73C15.68 19.17 16.45 18.86 17.24 18.86H18C19.66 18.86 21 17.52 21 15.88V4.97C21 3.33 19.66 2 18 2ZM12 5.55C13.08 5.55 13.95 6.43 13.95 7.5C13.95 8.56 13.11 9.41 12.07 9.45C12.03 9.45 11.97 9.45 11.92 9.45C10.87 9.41 10.04 8.56 10.04 7.5C10.05 6.43 10.92 5.55 12 5.55ZM14.75 14.69C13.24 15.7 10.76 15.7 9.25 14.69C7.92 13.81 7.92 12.35 9.25 11.46C10.77 10.45 13.25 10.45 14.75 11.46C16.08 12.35 16.08 13.8 14.75 14.69Z"/></svg>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="materialCard">
                    <h6 class="grey-color">Inactive Admin</h6>
                    <div class="dashboardSummaryCount flex-between">
                        <h2>{{number_format($account_inactive)}}</h2>
                        <span class="red-theme">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 2H6C4.34 2 3 3.33 3 4.97V15.88C3 17.52 4.34 18.86 6 18.86H6.76C7.55 18.86 8.32 19.17 8.88 19.73L10.59 21.42C11.37 22.19 12.63 22.19 13.41 21.42L15.12 19.73C15.68 19.17 16.45 18.86 17.24 18.86H18C19.66 18.86 21 17.52 21 15.88V4.97C21 3.33 19.66 2 18 2ZM12 5.55C13.08 5.55 13.95 6.43 13.95 7.5C13.95 8.56 13.11 9.41 12.07 9.45C12.03 9.45 11.97 9.45 11.92 9.45C10.87 9.41 10.04 8.56 10.04 7.5C10.05 6.43 10.92 5.55 12 5.55ZM14.75 14.69C13.24 15.7 10.76 15.7 9.25 14.69C7.92 13.81 7.92 12.35 9.25 11.46C10.77 10.45 13.25 10.45 14.75 11.46C16.08 12.35 16.08 13.8 14.75 14.69Z"/></svg>
                                </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="materialCard">
                    <div class="flex-between materialAddNew">
                        <div>
                            <h4>Fill in Admins details and submit.</h4>
                            <h6><div>An email will be sent to the Admin to login</div></h6>
                        </div>

                        <button class="materialButtonIcon opencloseModal" data-trigger-id="addNewAdmin">
                            <span>Create New</span>
                            <span class="buttonIcon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 12H22.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 22.5L12 1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="materialCard materialTableContainer mt-3">
                    <div class="materialCardTitle">
                        <div class="materialCardInline">
                            <div>
                                <h4>Admin List</h4>
                                <!--<h6 class="headingH6">Payouts Rate</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless notificationTable">
                            <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Admin Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $acct )
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$acct->lastname}} {{$acct->firstname}}</td>
                                        <td>{{$acct->phone}}</td>
                                        <td>{{$acct->email}}</td>
                                        <td>@if($acct->status == 1)
                                                <span class="green-theme">Active</span>
                                            @else
                                                <span class="red-theme">InActive</span>
                                            @endif
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($acct->created_at)->format('Y-m-d')}}</td>

                                        <td>
                                            <svg class="mainBodyRightContainerTrigger opencloseModal" data-trigger-id="viewAdmin{{$acct->id}}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.25 9.14969C18.94 5.51969 15.56 3.42969 12 3.42969C10.22 3.42969 8.49 3.94969 6.91 4.91969C5.33 5.89969 3.91 7.32969 2.75 9.14969C1.75 10.7197 1.75 13.2697 2.75 14.8397C5.06 18.4797 8.44 20.5597 12 20.5597C13.78 20.5597 15.51 20.0397 17.09 19.0697C18.67 18.0897 20.09 16.6597 21.25 14.8397C22.25 13.2797 22.25 10.7197 21.25 9.14969ZM12 16.0397C9.76 16.0397 7.96 14.2297 7.96 11.9997C7.96 9.76969 9.76 7.95969 12 7.95969C14.24 7.95969 16.04 9.76969 16.04 11.9997C16.04 14.2297 14.24 16.0397 12 16.0397Z"/><path d="M11.9984 9.14062C10.4284 9.14062 9.14844 10.4206 9.14844 12.0006C9.14844 13.5706 10.4284 14.8506 11.9984 14.8506C13.5684 14.8506 14.8584 13.5706 14.8584 12.0006C14.8584 10.4306 13.5684 9.14062 11.9984 9.14062Z"/></svg>
                                        </td>
                                    </tr>


                                    <!-- Modal Container (View Admin) -->
                                    <div class="materialModalContainer" data-trigger-content="viewAdmin{{$acct->id}}">
                                        <section class="mainBodyRightContainer">
                                            <div class="mainBodyRightDiv animate__animated">
                                                <div class="mainBodyRightDivTopBar">
                                                    <div>
                                                        <h4 class="headingH4">
                                                            {{$acct->firstname}} Profile
                                                        </h4>
                                                    </div>
                                                    <div class="closeModal">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.46967 3.46967C3.76256 3.17678 4.23744 3.17678 4.53033 3.46967L20.5303 19.4697C20.8232 19.7626 20.8232 20.2374 20.5303 20.5303C20.2374 20.8232 19.7626 20.8232 19.4697 20.5303L3.46967 4.53033C3.17678 4.23744 3.17678 3.76256 3.46967 3.46967Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M20.5303 3.46967C20.8232 3.76256 20.8232 4.23744 20.5303 4.53033L4.53033 20.5303C4.23744 20.8232 3.76256 20.8232 3.46967 20.5303C3.17678 20.2374 3.17678 19.7626 3.46967 19.4697L19.4697 3.46967C19.7626 3.17678 20.2374 3.17678 20.5303 3.46967Z"></path></svg>
                                                    </div>
                                                </div>

                                                <div class="container dashboardSummary">
                                                    <div class="row mb-5">
                                                        <div class="col-sm-12">
                                                            <div class="profileDashboard">
                                                                <div class="profileDashboardBanner">
                                                                    <div class="profileDashboardPhoto">
                                                                        <img src="assets/img/user.png" alt="">
                                                                    </div>
                                                                    <div class="profileDashboardContent">
                                                                        <h3>{{$acct->lastname}} {{$acct->firstname}}</h3>
                                                                        <h5>{{$acct->phone}}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-4">
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="materialCard">
                                                                <h6 class="grey-color">Password Reset</h6>
                                                                <h6>A New Password will be sent to the <br/>admin email</h6>
                                                                <div class="dashboardSummaryCount flex-between">

                                                                    <a href="{{route('admin.adminResetpassword', $acct->id)}}" class="orange-theme">
                                                                        Click here
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="materialCard">
                                                                <h6 class="grey-color">Activate/Deactivate</h6>
                                                                <h6>Deactivated admins will not be able to <br/>login</h6>
                                                                <div class="dashboardSummaryCount flex-between">

                                                                    <a href="{{route('admin.edAdmin', $acct->id)}}"  class="green-theme">
                                                                        Click Here
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="materialCard">
                                                                <h6 class="grey-color">Delete Account</h6>
                                                                <h6>Deleted account will not be able to login <br/>again and can not be recovered</h6>
                                                                <div class="dashboardSummaryCount flex-between">

                                                                    <a href="{{route('admin.deleteAdmin', $acct->id)}}" class="red-theme">
                                                                        Delete Account
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mainBodyRightDivCloseContainer"></div>
                                        </section>
                                    </div>


                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Container (Add New Aggregator) -->
    <div class="materialModalContainer" data-trigger-content="addNewAdmin">
        <div class="materialModalDiv">
            <div class="materialModalHeader">
                <div>
                    <h3>Add New Admin</h3>
                </div>
                <div class="closeModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 1.5L22.8627 22.5627" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.8625 1.5L1.49986 22.5627" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
            <form action="{{route('admin.createAdmin')}}" method="POST">
                @csrf
                <div class="materialCardForm">
                    <div class="flex-between">
                        <div><input type="text" class="firstName" name="firstName" placeholder="First Name" id=""></div>
                        <div><input type="text" class="lastName" name="lastName" placeholder="Last Name" id=""></div>
                    </div>
                    <div class="flex-between">
                        <div><input type="email" class="emailAddress" name="email" placeholder="Email Address" id=""></div>
                        <div><input type="number" class="phoneNumber" name="phone" placeholder="Phone Number" id=""></div>
                    </div>

                    <input type="submit" class="btn-primary">
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        FilePond.parse(document.body);
    </script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        });

        $(".jsonExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "json", filename: "sample.json",});
        });
        $(".csvExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "csv", filename: "sample.csv" });
        });
        $(".pdfExport").on("click", function () {
            $(".dataTable").tableHTMLExport({ type: "pdf", filename: "sample.pdf" });
        });
    </script>
@endsection
