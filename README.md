# Exam System Project

## สถานะการดำเนินงานปัจจุบัน (Current Progress)
- ติดตั้งและตั้งค่าสภาพแวดล้อมระบบด้วย Docker Compose สำเร็จ (Web, App, DB, Redis)
- ตั้งค่า Nginx และเชื่อมต่อฐานข้อมูลเบื้องต้นเรียบร้อยแล้ว
- สร้างโครงสร้าง Migration พื้นฐานของระบบสอบเรียบร้อย

## สิ่งที่ต้องทำต่อ (Remaining Tasks - Migrations)
ต้องรันคำสั่งสร้าง Migration สำหรับตารางที่เหลืออีก 10 ตาราง ดังนี้:

docker compose exec app php artisan make:migration create_curriculum_versions_table
docker compose exec app php artisan make:migration create_course_curriculum_table
docker compose exec app php artisan make:migration create_question_versions_table
docker compose exec app php artisan make:migration create_question_reviews_table
docker compose exec app php artisan make:migration create_question_status_history_table
docker compose exec app php artisan make:migration create_exam_sections_table
docker compose exec app php artisan make:migration create_grading_rules_table
docker compose exec app php artisan make:migration create_attempt_policies_table
docker compose exec app php artisan make:migration create_rubrics_table
docker compose exec app php artisan make:migration create_accommodations_table



