<?php

class MockResult
{
    public int $num_rows;

    private array $rows;
    private int $index = 0;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
        $this->num_rows = count($rows);
    }

    public function fetch_assoc(): ?array
    {
        if ($this->index >= count($this->rows)) {
            return null;
        }

        $row = $this->rows[$this->index];
        $this->index++;

        return $row;
    }
}

function ensure_mock_session(string $role = 'Resident', string $fullName = 'Demo User'): void
{
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = 101;
    }

    if (!isset($_SESSION['role'])) {
        $_SESSION['role'] = $role;
    }

    if (!isset($_SESSION['full_name'])) {
        $_SESSION['full_name'] = $fullName;
    }
}
