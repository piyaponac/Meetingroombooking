<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงาน PDF</title>
</head>
<body>
    <table width="100%" border ="1" cellspacing="0" >
        <thead>
            <tr>
                <td>ห้อง</td>
                <td>เรื่อง</td>
                <td>วันที่</td>
                <td>เวลา</td>
                <td>ถึงเวลา</td>
                <td>สถานะ</td>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->rooms_name }}</td>
                <td>{{ $booking->booking_title }}</td>
                <td>{{ date('d/m/Y',strtotime($booking->booking_date)) }}</td>
                <td>{{ $booking->booking_begin }}</td>
                <td>{{ $booking->booking_end }}</td>
              
                @if( $booking->booking_status == 1)
                <td>อนุมัติ</td>
                @elseif( $booking->booking_status == 2)
                <td>ไม่อนุมัติ</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>