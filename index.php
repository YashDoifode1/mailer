<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Mailer Application</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function updateForm() {
            const subject = document.getElementById('subject').value;
            document.querySelectorAll('.optional-field').forEach(field => field.style.display = 'none');
            if (subject === 'appointment') {
                document.getElementById('jobDetails').style.display = 'block';
            } else if (subject === 'thankyou') {
                document.getElementById('interviewerNameField').style.display = 'block';
            } else if (subject === 'job_application') {
                document.getElementById('jobDetails').style.display = 'block';
            } else if (subject === 'followup') {
                document.getElementById('previousSubjectField').style.display = 'block';
            } else if (subject === 'recommendation') {
                document.getElementById('recommendationField').style.display = 'block';
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form); // Create FormData object
                fetch('send.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const responseDiv = document.getElementById('response');
                    if (data.status === 'success') {
                        responseDiv.innerHTML = `<div style='color: green;'>${data.message}</div>`;
                    } else {
                        responseDiv.innerHTML = `<div style='color: red;'>${data.message}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('response').innerHTML = `<div style='color: red;'>An error occurred.</div>`;
                });
            });
        });
    </script>
</head>
<body>
    <div class="card">
        <h2>Send a Professional Email</h2>
        <form action="send.php" method="post">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email To:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Recipient's email address" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select id="subject" name="subject" class="form-control" required onchange="updateForm()">
                    <option value="appointment">Appointment Letter</option>
                    <option value="leave">Leave Application (Sickness)</option>
                    <option value="holiday">Holiday Request</option>
                    <option value="job_application">Job Application</option>
                    <option value="thankyou">Thank You After Interview</option>
                    <option value="followup">Follow-Up on Previous Email</option>
                    <option value="recommendation">Request for Recommendation Letter</option>
                    <option value="feedback">Client Feedback Request</option>
                </select>
            </div>

            <!-- Additional fields for specific email types -->
            <div id="jobDetails" class="optional-field" style="display:none;">
                <div class="form-group">
                    <label for="job_title">Job Title:</label>
                    <input type="text" id="job_title" name="job_title" class="form-control" placeholder="Enter job title">
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter company name">
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
            </div>

            <div id="interviewerNameField" class="optional-field" style="display:none;">
                <div class="form-group">
                    <label for="interviewer_name">Interviewer's Name:</label>
                    <input type="text" id="interviewer_name" name="interviewer_name" class="form-control" placeholder="Enter interviewer's name">
                </div>
            </div>

            <div id="previousSubjectField" class="optional-field" style="display:none;">
                <div class="form-group">
                    <label for="previous_subject">Previous Email Subject:</label>
                    <input type="text" id="previous_subject" name="previous_subject" class="form-control" placeholder="Enter the subject of your previous email">
                </div>
            </div>

            <div id="recommendationField" class="optional-field" style="display:none;">
                <div class="form-group">
                    <label for="recommendation_purpose">Purpose of Recommendation:</label>
                    <input type="text" id="recommendation_purpose" name="recommendation_purpose" class="form-control" placeholder="e.g., Graduate program at XYZ University">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Send Email</button>
            </div>
        </form>
        <div id="response" class="response"></div>
    </div>
</body>
</html>
