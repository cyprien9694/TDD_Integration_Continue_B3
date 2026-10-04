<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\StudentManager;

class StudentTest extends TestCase
{
    protected function setUp(): void
    {
        StudentManager::reset();
    }

    public function testGetAllStudents()
    {
        $students = StudentManager::getAll();
        $this->assertIsArray($students);
        $this->assertCount(6, $students);
    }

    public function testGetStudentByIdValid()
    {
        $student = StudentManager::getById(1);
        $this->assertNotNull($student);
        $this->assertEquals(1, $student['id']);
    }

    public function testGetStudentByIdNotFound()
    {
        $student = StudentManager::getById(999);
        $this->assertNull($student);
    }

    public function testCreateStudentValid()
    {
        $data = [
            "firstName" => "Jean",
            "lastName" => "Valjean",
            "email" => "jean.valjean@univ.fr",
            "grade" => 16.0,
            "field" => "informatique"
        ];
        $error = StudentManager::validate($data);
        $this->assertNull($error);

        $created = StudentManager::create($data);
        $this->assertArrayHasKey('id', $created);
        $this->assertEquals("Jean", $created['firstName']);
    }

    public function testCreateStudentMissingField()
    {
        $data = ["firstName" => "J"];
        $error = StudentManager::validate($data);
        $this->assertNotNull($error);
    }

    public function testCreateStudentInvalidGrade()
    {
        $data = [
            "firstName" => "Paul",
            "lastName" => "Emploi",
            "email" => "paul@univ.fr",
            "grade" => 25.0,
            "field" => "chimie"
        ];
        $error = StudentManager::validate($data);
        $this->assertNotNull($error);
    }

    public function testCreateStudentDuplicateEmail()
    {
        $data = [
            "firstName" => "Alice",
            "lastName" => "Clone",
            "email" => "alice.martin@univ.fr",
            "grade" => 12.0,
            "field" => "physique"
        ];
        $error = StudentManager::validate($data);
        $this->assertEquals("Email déjà pris", $error);
    }

    public function testUpdateStudentValid()
    {
        $updateData = ["grade" => 19.0];
        $error = StudentManager::validate($updateData, true, 1);
        $this->assertNull($error);

        $updated = StudentManager::update(1, $updateData);
        $this->assertEquals(19.0, $updated['grade']);
    }

    public function testUpdateStudentNotFound()
    {
        $result = StudentManager::update(999, ["grade" => 10]);
        $this->assertNull($result);
    }

    public function testDeleteStudentValid()
    {
        $success = StudentManager::delete(1);
        $this->assertTrue($success);
        $this->assertNull(StudentManager::getById(1));
    }

    public function testDeleteStudentNotFound()
    {
        $success = StudentManager::delete(999);
        $this->assertFalse($success);
    }

    public function testGetStats()
    {
        $stats = StudentManager::getStats();
        $this->assertArrayHasKey('totalStudents', $stats);
        $this->assertArrayHasKey('averageGrade', $stats);
        $this->assertArrayHasKey('studentsByField', $stats);
        $this->assertArrayHasKey('bestStudent', $stats);
        $this->assertEquals(5, $stats['totalStudents']);
    }

    public function testSearchStudents()
    {
        $results = StudentManager::search("alice");
        $this->assertNotEmpty($results);
        $this->assertEquals("Alice", $results[0]['firstName']);
    }

    public function testSearchStudentsNotFound()
    {
        $results = StudentManager::search("inconnu");
        $this->assertEmpty($results);
    }

    public function testValidationInvalidField()
    {
        $data = [
            "firstName" => "Test",
            "lastName" => "User",
            "email" => "test@univ.fr",
            "grade" => 10,
            "field" => "invalide"
        ];
        $error = StudentManager::validate($data);
        $this->assertEquals("Filière invalide", $error);
    }
}
