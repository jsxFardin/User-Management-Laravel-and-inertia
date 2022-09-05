<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        body,html {
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center flex-column justify-content-center h-100 bg-dark text-white" id="header">
        <h2>Upload CSV</h2>
        <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <select class="form-control" name="category" id="category">
                    <option value="">Select File Type</option>
                    <option value="camp-block">Camp & Block</option>
                    <option value="construction_status">Construction Status</option>
                    <option value="donors">Donors</option>
                    <option value="facility_types">Facility Type</option>
                    <option value="facility_useds">Facility Used</option>
                    <option value="latrine_structures">Latrine Structure</option>
                    <option value="pit_types">Pit Type</option>
                    <option value="sludge_transfers">Sludge Transfers</option>
                    <option value="sanitation_zones">Sanitation Zones</option>
                    <option value="latrine">Latrine</option>
                    <option value="latrine_zones">Latrine Zones</option>
                </select>
                @error('category')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="attachment">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                @error('category')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-sm btn-lg btn-block">Start Import</button>
            </div>
        </form>
    </div>
</body>
</html>
