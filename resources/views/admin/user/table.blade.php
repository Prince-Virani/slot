<div class="table-responsive">
    <table class="display" id="example-style-1">
        <thead>
        <tr>
            <th>Booking Request</th>
            <th>Full Name</th>
            <th>Mobile Number</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Turf</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{$customer->user_id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->mobile_number}}</td>
                <td data-order="{{strtotime($customer->date)}}">{{$customer->date}}</td>
                <td>{{$customer->booking_time}}</td>
                <td>
                    {{$customer->booking_ground}}

                </td>
                <td>
                    <div class="custom-card p-0">
                        <ul class="card-social p-0">
                            <li>
                                <a onclick="confirmdelete({{$customer->user_id}})">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Booking Request</th>
            <th>Full Name</th>
            <th>Mobile Number</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Ground</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    $(function () {
       $('#example-style-1').DataTable({
            columnDefs: [
                { orderable: false, targets: [0] }
            ],
            order: [[0, 'desc']]
        });
    });
</script>

