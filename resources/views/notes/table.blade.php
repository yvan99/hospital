<!DOCTYPE html>
<html>
<head>
    <title>Medical Progress Report</title>
    <style>
        body {
            font-family: century Gothic , Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            text-transform: capitalize;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 18px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Medical Progress Report</h1>
    <div class="patient-info">
        <p><strong>Patient Name:</strong> {{ $patient->names }}</p>
        <p><strong>Patient ID:</strong> {{ $patient->code }}</p>
        <p><strong>Age:</strong> {{ $patient->age }}</p>
        <p><strong>Gender:</strong> {{ $patient->gender }}</p>
    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Note</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td width="100">{{ $note->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{ $note->message }} <br><br>
                        <small>By : {{$note->user_type}} {{$note->user_name}}</small>
                    </td>
                </tr>
            @endforeach
        </tbody>
       
    </table>
    <br>
    <small> <i>Generated By System on {{ \Carbon\Carbon::now()->format('l, d F Y') }}</i> </small>
    <br>
    <button onclick="window.print()">Print Report</button>
</body>
</html>
