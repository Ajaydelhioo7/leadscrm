<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enquiry Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Enquiry Form</h2>
        </div>
        <div class="card-body">
            <form action="process_enquiry.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="student_name">Student’s Name:</label>
                        <input type="text" class="form-control" id="student_name" name="student_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mob_no">Mob. No.:</label>
                        <input type="text" class="form-control" id="mob_no" name="mob_no">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="qualification">Qualification:</label>
                        <select class="form-control" id="qualification" name="qualification">
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
                        <input class="form-check-input" type="radio" name="attempted_prelims" id="prelims_yes" value="Yes">
                        <label class="form-check-label" for="prelims_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="attempted_prelims" id="prelims_no" value="No">
                        <label class="form-check-label" for="prelims_no">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>How did you get to know about us?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="know_about_us[]" value="Google Search for UPSC notes">
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
                        <input class="form-check-input" type="checkbox" name="enquiring_for[]" value="GS Foundation">
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
                        <input class="form-check-input" type="checkbox" name="test_series[]" value="Prelims">
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
                        <input type="text" class="form-control" id="target_year" name="target_year">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Medium:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medium" id="medium_english" value="English">
                            <label class="form-check-label" for="medium_english">English</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medium" id="medium_hindi" value="Hindi">
                            <label class="form-check-label" for="medium_hindi">Hindi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mode:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mode" id="mode_offline" value="Offline">
                        <label class="form-check-label" for="mode_offline">Offline</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mode" id="mode_online" value="Online">
                        <label class="form-check-label" for="mode_online">Online</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="enquiry_by">Enquiry By:</label>
                        <input type="text" class="form-control" id="enquiry_by" name="enquiry_by">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="counsellor">Counsellor:</label>
                        <input type="text" class="form-control" id="counsellor" name="counsellor">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="center">Center:</label>
                        <input type="text" class="form-control" id="center" name="center">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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
