<section class="w-full">
    <div class="flex flex-col gap-6 p-6">
        <div>
            <flux:heading size="xl">User Management</flux:heading>
            <flux:subheading>Manage users, roles and permissions</flux:subheading>
        </div>

        @if (session()->has('success'))
            <flux:callout variant="success" icon="check-circle" class="mb-4">
                {{ session('success') }}
            </flux:callout>
        @endif

        <!-- Assign Role Form -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <flux:heading size="lg" class="mb-4">Assign Role to User</flux:heading>

            <form wire:submit="assignRole" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <flux:select wire:model="selectedUser" label="Select User" placeholder="Choose a user">
                        @foreach($users as $user)
                            <flux:select.option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->email }})</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:select wire:model="selectedRole" label="Select Role" placeholder="Choose a role">
                        @foreach($roles as $role)
                            <flux:select.option value="{{ $role->name }}">{{ $role->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>

                <flux:button type="submit" variant="primary">
                    Assign Role
                </flux:button>
            </form>
        </div>

        <!-- Users and Their Roles -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex justify-between items-center mb-4">
                <flux:heading size="lg">Users & Roles</flux:heading>
                <div class="flex gap-2">
                    <flux:button wire:click="toggleDeletedUsersView" variant="ghost" icon="archive-box" size="sm">
                        {{ $showDeletedUsers ? 'Show Active Users' : 'Show Deleted Users' }}
                    </flux:button>
                    <flux:button wire:click="openCreateUserModal" variant="primary" icon="plus" size="sm">
                        Add User
                    </flux:button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-zinc-900">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Avatar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Roles</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach(($showDeletedUsers ? $deletedUsers : $users) as $user)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <flux:avatar
                                        :src="$user->avatar ? asset('storage/' . $user->avatar) : null"
                                        :name="$user->full_name"
                                        size="sm"
                                    />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->full_name }}</div>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $user->username }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-zinc-100">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->roles as $role)
                                            <flux:badge 
                                                variant="solid" 
                                                color="{{ 
                                                    $role->name === 'Super Admin' ? 'red' : (
                                                    $role->name === 'Admin' ? 'blue' : (
                                                    $role->name === 'User' ? 'green' : (
                                                    $role->name === 'Guest' ? 'purple' : null)))
                                                }}" 
                                                size="sm"
                                            >
                                                {{ $role->name }}
                                            </flux:badge>
                                        @empty
                                            <flux:badge variant="outline" size="sm">No Role</flux:badge>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($showDeletedUsers)
                                            <!-- Actions for deleted users -->
                                            <flux:button 
                                                size="sm" 
                                                variant="primary" 
                                                icon="arrow-path"
                                                wire:click="restoreUser({{ $user->id }})"
                                                wire:confirm="Are you sure you want to restore {{ $user->full_name }}?"
                                            >
                                                Restore
                                            </flux:button>

                                            <flux:button 
                                                size="sm" 
                                                variant="danger" 
                                                icon="trash"
                                                wire:click="permanentlyDeleteUser({{ $user->id }})"
                                                wire:confirm="Are you sure you want to permanently delete {{ $user->full_name }}? This action cannot be undone!"
                                            >
                                                Delete Forever
                                            </flux:button>
                                        @else
                                            <!-- Actions for active users -->
                                            <flux:button 
                                                size="sm" 
                                                variant="ghost" 
                                                icon="pencil"
                                                wire:click="openEditUserModal({{ $user->id }})"
                                            >
                                                Edit
                                            </flux:button>
                                            
                                            @if($user->roles->count() > 0)
                                                <flux:dropdown>
                                                    <flux:button size="sm" variant="ghost" icon="minus">
                                                        Remove Role
                                                    </flux:button>
                                                    <flux:menu>
                                                        @foreach($user->roles as $role)
                                                            <flux:menu.item
                                                                wire:click="removeRole({{ $user->id }}, '{{ $role->name }}')"
                                                                wire:confirm="Are you sure you want to remove the '{{ $role->name }}' role from {{ $user->full_name }}?"
                                                                icon="minus"
                                                            >
                                                                Remove {{ $role->name }}
                                                            </flux:menu.item>
                                                        @endforeach
                                                    </flux:menu>
                                                </flux:dropdown>
                                            @endif

                                            <flux:button 
                                                size="sm" 
                                                variant="danger" 
                                                icon="trash"
                                                wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Are you sure you want to delete {{ $user->full_name }}? This action can be undone from the deleted users view."
                                            >
                                                Delete
                                            </flux:button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Available Roles -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <flux:heading size="lg" class="mb-4">Available Roles</flux:heading>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($roles as $role)
                    <div class="p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                        <flux:heading size="sm" class="mb-2">{{ $role->name }}</flux:heading>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">
                            {{ $role->users_count ?? $role->users()->count() }} users
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- User Form Modal -->
        <flux:modal wire:model="showUserModal" name="user-modal">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ $editingUser ? 'Edit User' : 'Create New User' }}</flux:heading>
                </div>

                <form wire:submit="saveUser" class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <flux:field>
                            <flux:label>First Name</flux:label>
                            <flux:input wire:model="firstName" placeholder="Enter first name" />
                            <flux:error name="firstName" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Last Name</flux:label>
                            <flux:input wire:model="lastName" placeholder="Enter last name" />
                            <flux:error name="lastName" />
                        </flux:field>
                    </div>

                    <flux:field>
                        <flux:label>Username</flux:label>
                        <flux:input wire:model="username" placeholder="Enter username" />
                        <flux:error name="username" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Email</flux:label>
                        <flux:input type="email" wire:model="email" placeholder="Enter email address" />
                        <flux:error name="email" />
                    </flux:field>

                    <div class="grid grid-cols-2 gap-4">
                        <flux:field>
                            <flux:label>
                                Password
                                @if($editingUser)
                                    <span class="text-xs text-zinc-500">(Leave blank to keep current)</span>
                                @endif
                            </flux:label>
                            <flux:input type="password" wire:model="password" placeholder="Enter password" />
                            <flux:error name="password" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Confirm Password</flux:label>
                            <flux:input type="password" wire:model="passwordConfirmation" placeholder="Confirm password" />
                            <flux:error name="passwordConfirmation" />
                        </flux:field>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <flux:button type="button" wire:click="closeUserModal" variant="ghost">
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary">
                            {{ $editingUser ? 'Update User' : 'Create User' }}
                        </flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>
    </div>
</section>
