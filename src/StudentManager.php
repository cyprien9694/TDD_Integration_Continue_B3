<?php

namespace App;

class StudentManager
{
    private static array $students = [
        ["id" => 1, "firstName" => "Alice", "lastName" => "Martin", "email" => "alice.martin@univ.fr", "grade" => 14.5, "field" => "informatique"],
        ["id" => 2, "firstName" => "Bob", "lastName" => "Dupont", "email" => "bob.dupont@univ.fr", "grade" => 12.0, "field" => "mathématiques"],
        ["id" => 3, "firstName" => "Charlie", "lastName" => "Durand", "email" => "charlie.durand@univ.fr", "grade" => 16.0, "field" => "physique"],
        ["id" => 4, "firstName" => "Diana", "lastName" => "Prince", "email" => "diana.prince@univ.fr", "grade" => 18.5, "field" => "chimie"],
        ["id" => 5, "firstName" => "Ethan", "lastName" => "Hunt", "email" => "ethan.hunt@univ.fr", "grade" => 10.0, "field" => "informatique"]
    ];
    private static int $nextId = 6;

    public static function reset(): void
    {
        self::$students = [
            ["id" => 1, "firstName" => "Alice", "lastName" => "Martin", "email" => "alice.martin@univ.fr", "grade" => 14.5, "field" => "informatique"],
            ["id" => 2, "firstName" => "Bob", "lastName" => "Dupont", "email" => "bob.dupont@univ.fr", "grade" => 12.0, "field" => "mathématiques"],
            ["id" => 3, "firstName" => "Charlie", "lastName" => "Durand", "email" => "charlie.durand@univ.fr", "grade" => 16.0, "field" => "physique"],
            ["id" => 4, "firstName" => "Diana", "lastName" => "Prince", "email" => "diana.prince@univ.fr", "grade" => 18.5, "field" => "chimie"],
            ["id" => 5, "firstName" => "Ethan", "lastName" => "Hunt", "email" => "ethan.hunt@univ.fr", "grade" => 10.0, "field" => "informatique"]
        ];
        self::$nextId = 6;
    }

    public static function getAll(): array
    {
        return self::$students;
    }

    public static function getById($id): ?array
    {
        foreach (self::$students as $s) {
            if ($s['id'] === (int)$id) {
                return $s;
            }
        }
        return null;
    }

    public static function validate(array $data, bool $isUpdate = false, ?int $currentId = null): ?string
    {
        $validFields = ["informatique", "mathématiques", "physique", "chimie"];

        if (!$isUpdate || isset($data['firstName'])) {
            if (!isset($data['firstName']) || !is_string($data['firstName']) || mb_strlen(trim($data['firstName'])) < 2) {
                return "Prénom invalide (min 2 caractères)";
            }
        }
        if (!$isUpdate || isset($data['lastName'])) {
            if (!isset($data['lastName']) || !is_string($data['lastName']) || mb_strlen(trim($data['lastName'])) < 2) {
                return "Nom invalide (min 2 caractères)";
            }
        }
        if (!$isUpdate || isset($data['email'])) {
            if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                return "Email invalide";
            }
            foreach (self::$students as $s) {
                if ($s['email'] === $data['email'] && ($currentId === null || $s['id'] !== $currentId)) {
                    return "Email déjà pris";
                }
            }
        }
        if (!$isUpdate || isset($data['grade'])) {
            if (!isset($data['grade']) || !is_numeric($data['grade']) || $data['grade'] < 0 || $data['grade'] > 20) {
                return "Note invalide (entre 0 et 20)";
            }
        }
        if (!$isUpdate || isset($data['field'])) {
            if (!isset($data['field']) || !in_array($data['field'], $validFields)) {
                return "Filière invalide";
            }
        }
        return null;
    }

    public static function create(array $data): array
    {
        $newStudent = [
            "id" => self::$nextId++,
            "firstName" => trim($data['firstName']),
            "lastName" => trim($data['lastName']),
            "email" => $data['email'],
            "grade" => (float)$data['grade'],
            "field" => $data['field']
        ];
        self::$students[] = $newStudent;
        return $newStudent;
    }

    public static function update(int $id, array $data): ?array
    {
        foreach (self::$students as &$s) {
            if ($s['id'] === $id) {
                if (isset($data['firstName'])) {
                    $s['firstName'] = trim($data['firstName']);
                }
                if (isset($data['lastName'])) {
                    $s['lastName'] = trim($data['lastName']);
                }
                if (isset($data['email'])) {
                    $s['email'] = $data['email'];
                }
                if (isset($data['grade'])) {
                    $s['grade'] = (float)$data['grade'];
                }
                if (isset($data['field'])) {
                    $s['field']  = $data['field'];
                }
                return $s;
            }
        }
        return null;
    }

    public static function delete(int $id): bool
    {
        foreach (self::$students as $i => $s) {
            if ($s['id'] === $id) {
                unset(self::$students[$i]);
                self::$students = array_values(self::$students);
                return true;
            }
        }
        return false;
    }

    public static function getStats(): array
    {
        if (empty(self::$students)) {
            return ["totalStudents" => 0, "averageGrade" => 0, "studentsByField" => [], "bestStudent" => null];
        }
        $total = count(self::$students);
        $sum = array_sum(array_column(self::$students, 'grade'));
        $avg = round($sum / $total, 2);

        $byField = [];
        $best = self::$students[0];

        foreach (self::$students as $s) {
            $byField[$s['field']] = ($byField[$s['field']] ?? 0) + 1;
            if ($s['grade'] > $best['grade']) {
                $best = $s;
            }
        }

        return [
            "totalStudents" => $total,
            "averageGrade" => $avg,
            "studentsByField" => $byField,
            "bestStudent" => $best
        ];
    }

    public static function search(string $query): array
    {
        $query = mb_strtolower(trim($query));
        $results = [];
        foreach (self::$students as $s) {
            if (mb_strpos(mb_strtolower($s['firstName']), $query) !== false || mb_strpos(mb_strtolower($s['lastName']), $query) !== false) {
                $results[] = $s;
            }
        }
        return $results;
    }
}
