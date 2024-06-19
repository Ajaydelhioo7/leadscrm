<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enquiry Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: orange;
            color: white;
            border-bottom: none;
            border-radius: 1rem 1rem 0 0;
        }
        .btn-primary {
            background-color: orange;
            border-color: orange;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container animate__animated animate__fadeIn">
    <div class="card">
        <div class="card-header text-center">
            <h3>Enquiry Form 99Notes</h3>
        </div>
        <div class="card-body">
            <form action="process_enquiry.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="student_name">Student’s Name:</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mob_no">Mob. No.:</label>
                        <input type="text" class="form-control" id="mob_no" name="mob_no" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="qualification">Qualification:</label>
                        <select class="form-control" id="qualification" name="qualification" required>
                            <option value="10th">10th</option>
                            <option value="12th">12th</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Masters">Masters</option>
                            <option value="Pursuing">Pursuing</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="pursuing_specification" name="pursuing_specification" placeholder="Please specify if pursuing">
                    </div>
                </div>
                <div class="form-group">
                    <label>Have you ever attempted Prelims before?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attempted_prelims" id="prelims_yes" value="Yes" required>
                        <label class="form-check-label" for="prelims_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attempted_prelims" id="prelims_no" value="No" required>
                        <label class="form-check-label" for="prelims_no">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>How did you get to know about us?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Google Search for UPSC notes" >
                        <label class="form-check-label">Google Search for UPSC notes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Third party websites">
                        <label class="form-check-label">Third party websites</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Newspaper">
                        <label class="form-check-label">Newspaper</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Magazines">
                        <label class="form-check-label">Magazines</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Social media">
                        <label class="form-check-label">Social media</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Friends">
                        <label class="form-check-label">Friends</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Teachers">
                        <label class="form-check-label">Teachers</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Others">
                        <label class="form-check-label">Others (Please specify)</label>
                    </div>
                    <input type="text" class="form-control mt-2" id="know_about_us_other" name="know_about_us_other" placeholder="Please specify if others">
                </div>
                <div class="form-group">
                    <label>You are enquiring for?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enquiring_for[]" value="GS Foundation" >
                        <label class="form-check-label">GS Foundation</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enquiring_for[]" value="Essay">
                        <label class="form-check-label">Essay</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enquiring_for[]" value="CSAT">
                        <label class="form-check-label">CSAT</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="enquiring_for_optional" value="Optional">
                        <label class="form-check-label">Optional (Please specify)</label>
                    </div>
                    <input type="text" class="form-control mt-2" id="optional_specification" name="optional_specification" placeholder="Please specify if optional">
                </div>
                <div class="form-group">
                    <label>Test Series</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="test_series[]" value="Prelims" >
                        <label class="form-check-label">Prelims</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="test_series[]" value="Mains">
                        <label class="form-check-label">Mains</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="test_series_optional" value="Optional">
                        <label class="form-check-label">Optional (Please specify)</label>
                    </div>
                    <input type="text" class="form-control mt-2" id="test_series_optional_specification" name="test_series_optional_specification" placeholder="Please specify if optional">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="target_year">Target Year:</label>
                        <input type="text" class="form-control" id="target_year" name="target_year" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Medium:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medium" id="medium_english" value="English" required>
                            <label class="form-check-label" for="medium_english">English</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medium" id="medium_hindi" value="Hindi" required>
                            <label class="form-check-label" for="medium_hindi">Hindi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mode:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mode" id="mode_offline" value="Offline" required>
                        <label class="form-check-label" for="mode_offline">Offline</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mode" id="mode_online" value="Online" required>
                        <label class="form-check-label" for="mode_online">Online</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#optional_specification').hide();
        $('#test_series_optional_specification').hide();

        $('#enquiring_for_optional').change(function() {
            if ($(this).is(':checked')) {
                $('#optional_specification').show();
            } else {
                $('#optional_specification').hide();
            }
        });

        $('#test_series_optional').change(function() {
            if ($(this).is(':checked')) {
                $('#test_series_optional_specification').show();
            } else {
                $('#test_series_optional_specification').hide();
            }
        });
    });
</script>
</body>
</html>