<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        // 🔹 General
        case "website_info": echo "This is an online hospital management system where patients can book appointments, check schedules, and connect with doctors."; break;
        case "create_account": echo "Click on ‘Sign Up’ on the homepage and fill in your details to create a new patient account."; break;
        case "login": echo "Go to the Login page and enter your registered email and password."; break;
        case "forgot_password": echo "Please contact the hospital administration for password recovery."; break;
        case "book_appointment": echo "After logging in as a patient, go to the ‘Appointments’ section, choose a doctor and schedule, and confirm your booking."; break;
        case "view_appointments": echo "Yes, log in to your patient dashboard and check the ‘My Appointments’ section."; break;
        case "cancel_appointment": echo "Go to your ‘My Appointments’ page and click the cancel option next to the appointment."; break;
        case "view_doctors": echo "Login and navigate to the ‘Doctors’ section to view the list of available doctors."; break;
        case "doctor_specialization": echo "The doctor’s profile includes specialization and availability details."; break;
        case "logout": echo "Click on ‘Logout’ from your dashboard menu."; break;

        // 🔹 Doctor Related
        case "doctor": echo "Rahul Parakash is the best orthopedic doctor."; break;
        case "ortho": echo "Dr. Rahul Parakash is the top-rated orthopedic specialist for bone and joint issues."; break;
        case "liver": echo "Dr. Mehta is our leading hepatologist for liver issues."; break;
        case "doctor_heart": echo "For heart-related issues such as chest pain, palpitations, or high blood pressure, you should consult a Cardiologist."; break;
        case "doctor_skin": echo "For skin problems like rashes, acne, or allergies, you should visit a Dermatologist."; break;
        case "doctor_diabetes": echo "Diabetes is managed by an Endocrinologist, but general physicians can also help with initial treatment."; break;
        case "doctor_kidney": echo "For kidney-related problems such as stones or chronic kidney disease, consult a Nephrologist."; break;
        case "doctor_eye": echo "For eye issues like blurry vision, pain, or infections, consult an Ophthalmologist."; break;
        case "doctor_pregnancy": echo "For pregnancy care, women should consult a Gynecologist or Obstetrician."; break;
        case "doctor_cancer": echo "Cancer treatment is handled by an Oncologist. You should book an appointment with our oncology department."; break;
        case "doctor_ent": echo "For problems related to ear, nose, and throat, consult an ENT Specialist."; break;
        case "doctor_online": echo "Yes, some doctors are available for online consultations. Check their availability in the doctor schedule."; break;
        case "doctor_best": echo "You can view each doctor’s specialization and availability in the Doctors section before booking."; break;

        // 🔹 Disease Related
        case "fever": echo "Drink plenty of fluids, rest, and take paracetamol if needed. If fever lasts more than 3 days or is very high, consult a doctor immediately."; break;
        case "diabetes": echo "Regular exercise, a healthy diet, and timely medication help manage diabetes. You should also have regular checkups with an endocrinologist."; break;
        case "chest_pain": echo "If you feel chest pain, it could be serious. Seek emergency medical care immediately and consult a cardiologist."; break;
        case "headache": echo "Headaches can be caused by stress, lack of sleep, or vision issues. Drink water, rest well, and if headaches are frequent, consult a Neurologist."; break;
        case "stomach_pain": echo "For stomach-related problems, visit a Gastroenterologist. If it’s sudden severe pain, go to the emergency department."; break;
        case "breathing": echo "Difficulty in breathing can be related to asthma, allergies, or heart problems. Consult a Pulmonologist or Cardiologist as needed."; break;
        case "eye_problem": echo "If you have red eyes, pain, or vision issues, you should consult an Ophthalmologist."; break;
        case "pregnancy": echo "For prenatal checkups, pregnancy-related issues, or delivery, please consult a Gynecologist or Obstetrician."; break;
        case "cancer": echo "Cancer treatment requires consultation with an Oncologist. Early detection is important."; break;
        case "allergy": echo "Allergies can be treated with Antihistamines. For chronic allergies, consult an Allergist."; break;

        // 🔹 Hospital / Services
        case "services": echo "We offer general consultation, surgery, diagnostics, emergency care, online doctor consultations, maternity care, cancer treatment, and more."; break;
        case "availability": echo "You should consult liver-specialist Rohan Mehta. Availability can be checked under the Doctors section."; break;
        case "timing": echo "We are open Mon-Sat from 9 AM to 6 PM."; break;
        case "support": echo "You can call our helpline at 1800-000-000 or email support@hospital.com"; break;
        case "emergency": echo "Call 108 or reach the emergency ward immediately."; break;
        case "insurance": echo "Yes, we accept major health insurance policies. Please contact the billing desk for details."; break;
        case "rooms": echo "We have general wards, private rooms, and ICU facilities available depending on patient needs."; break;

        default: echo "Sorry, I don’t have an answer for that yet.";
    }
} else {
    echo "No action received.";
}
?>
