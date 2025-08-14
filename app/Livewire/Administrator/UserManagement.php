<?php

namespace App\Livewire\Administrator;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    public $users;

    public $roles;

    public $selectedUser = '';

    public $selectedRole = '';

    // User CRUD properties
    public $showUserModal = false;

    public $editingUser = null;

    public $firstName = '';

    public $lastName = '';

    public $username = '';

    public $email = '';

    public $password = '';

    public $passwordConfirmation = '';

    public $isActive = true;

    // Deleted users properties
    public $showDeletedUsers = false;

    public $deletedUsers = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->users = User::with('roles')->get();
        $this->roles = Role::withCount('users')->get();
        $this->loadDeletedUsers();

        // Dispatch event to refresh chart
        $this->dispatch('refreshChart');
    }

    public function getRoleChartDataProperty()
    {
        $roleData = $this->roles->map(function ($role) {
            return [
                'name' => $role->name,
                'count' => $role->users_count,
                'color' => $this->getRoleColor($role->name),
            ];
        });

        return [
            'labels' => $roleData->pluck('name')->toArray(),
            'data' => $roleData->pluck('count')->toArray(),
            'colors' => $roleData->pluck('color')->toArray(),
        ];
    }

    private function getRoleColor($roleName)
    {
        $colors = [
            'Super Admin' => '#ef4444',
            'Admin' => '#3b82f6',
            'User' => '#10b981',
            'Guest' => '#8b5cf6',
        ];

        return $colors[$roleName] ?? '#6b7280';
    }

    public function loadDeletedUsers()
    {
        $this->deletedUsers = User::onlyTrashed()->with('roles')->get();
    }

    public function toggleDeletedUsersView()
    {
        $this->showDeletedUsers = ! $this->showDeletedUsers;
    }

    public function assignRole()
    {
        $this->validate([
            'selectedUser' => 'required|exists:users,id',
            'selectedRole' => 'required|exists:roles,name',
        ]);

        $user = User::find($this->selectedUser);
        $user->assignRole($this->selectedRole);

        $this->reset(['selectedUser', 'selectedRole']);
        $this->loadData();

        session()->flash('success', 'Role assigned successfully!');
    }

    public function removeRole($userId, $roleName)
    {
        $user = User::find($userId);
        $user->removeRole($roleName);

        $this->loadData();

        session()->flash('success', 'Role removed successfully!');
    }

    // User CRUD Methods
    public function openCreateUserModal()
    {
        $this->resetUserForm();
        $this->editingUser = null;
        $this->showUserModal = true;
    }

    public function openEditUserModal($userId)
    {
        $user = User::find($userId);
        $this->editingUser = $user;
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->isActive = $user->is_active;
        $this->password = '';
        $this->passwordConfirmation = '';
        $this->showUserModal = true;
    }

    public function saveUser()
    {
        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.($this->editingUser ? $this->editingUser->id : 'NULL'),
            'email' => 'required|email|max:255|unique:users,email,'.($this->editingUser ? $this->editingUser->id : 'NULL'),
        ];

        if (! $this->editingUser) {
            $rules['password'] = 'required|min:8';
            $rules['passwordConfirmation'] = 'required|same:password';
        } elseif ($this->password) {
            $rules['password'] = 'min:8';
            $rules['passwordConfirmation'] = 'same:password';
        }

        $this->validate($rules);

        if ($this->editingUser) {
            // Update existing user
            $this->editingUser->update([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'username' => $this->username,
                'email' => $this->email,
                'is_active' => $this->isActive,
            ]);

            if ($this->password) {
                $this->editingUser->update([
                    'password' => Hash::make($this->password),
                ]);
            }

            $message = 'User updated successfully!';
        } else {
            // Create new user
            User::create([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'is_active' => $this->isActive,
            ]);

            $message = 'User created successfully!';
        }

        $this->closeUserModal();
        $this->loadData();
        session()->flash('success', $message);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();

        $this->loadData();
        session()->flash('success', 'User deleted successfully!');
    }

    public function restoreUser($userId)
    {
        $user = User::onlyTrashed()->find($userId);
        $user->restore();

        $this->loadData();
        session()->flash('success', 'User restored successfully!');
    }

    public function permanentlyDeleteUser($userId)
    {
        $user = User::onlyTrashed()->find($userId);
        $user->forceDelete();

        $this->loadData();
        session()->flash('success', 'User permanently deleted!');
    }

    public function toggleUserStatus($userId)
    {
        $user = User::find($userId);
        $user->update(['is_active' => ! $user->is_active]);

        $this->loadData();
        $status = $user->is_active ? 'activated' : 'deactivated';
        session()->flash('success', "User {$status} successfully!");
    }

    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->resetUserForm();
    }

    private function resetUserForm()
    {
        $this->firstName = '';
        $this->lastName = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->passwordConfirmation = '';
        $this->isActive = true;
        $this->editingUser = null;
    }

    public function render()
    {
        return view('livewire.administrator.user-management');
    }
}
