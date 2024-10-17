// document.getElementById('mailForm').addEventListener('submit', function(e) {
//     e.preventDefault();
    
//     const formData = new FormData(this);
//     fetch('send_mail.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.text())
//     .then(data => {
//         document.getElementById('response').innerHTML = data;
//     })
//     .catch(error => {
//         document.getElementById('response').innerHTML = 'An error occurred: ' + error;
//     });
// });



        const subjectSelect = document.getElementById('subject');
        const additionalFields = document.getElementById('additionalFields');
        const jobTitleField = document.getElementById('jobTitleField');
        const companyNameField = document.getElementById('companyNameField');
        const interviewerNameField = document.getElementById('interviewerNameField');
        const previousSubjectField = document.getElementById('previousSubjectField');
        const recommendationPurposeField = document.getElementById('recommendationPurposeField');
        const startDateField = document.getElementById('startDateField');
        const endDateField = document.getElementById('endDateField');

        subjectSelect.addEventListener('change', function() {
            additionalFields.style.display = 'block';
            jobTitleField.style.display = 'none';
            companyNameField.style.display = 'none';
            interviewerNameField.style.display = 'none';
            previousSubjectField.style.display = 'none';
            recommendationPurposeField.style.display = 'none';
            startDateField.style.display = 'none';
            endDateField.style.display = 'none';

            switch (this.value) {
                case 'job_application':
                    jobTitleField.style.display = 'block';
                    companyNameField.style.display = 'block';
                    break;
                case 'thankyou':
                    interviewerNameField.style.display = 'block';
                    jobTitleField.style.display = 'block';
                    companyNameField.style.display = 'block';
                    break;
                case 'followup':
                    previousSubjectField.style.display = 'block';
                    break;
                case 'recommendation':
                    recommendationPurposeField.style.display = 'block';
                    break;
                case 'leave':
                case 'holiday':
                    startDateField.style.display = 'block';
                    endDateField.style.display = 'block';
                    break;
            }
        });
    