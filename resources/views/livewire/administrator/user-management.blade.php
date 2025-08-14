<section class="w-full">
    <div class="flex flex-col gap-6 p-6">
        <div>
            <flux:heading size="xl">User Management</flux:heading>
            <flux:subheading>Manage users, roles and permissions</flux:subheading>
        </div>

        @if (session()->has('success'))
            <flux:callout variant="success" icon="check-circle" inline="true    ">
                <flux:callout.heading>{{ session('success') }}</flux:callout.heading>

                <x-slot name="actions">
                    <flux:button icon="x-mark" wire:click="$refresh" />
                </x-slot>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
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
                                        size="md"
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
                                    <flux:badge
                                        color="{{ $user->is_active ? 'green' : 'red' }}"
                                        size="sm"
                                    >
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </flux:badge>
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
                                    <flux:dropdown position="top" align="end">
                                        <flux:button icon="ellipsis-horizontal" />
                                        <flux:menu>
                                            @if($showDeletedUsers)
                                                <!-- Actions for deleted users -->
                                                <flux:menu.item
                                                    wire:click="restoreUser({{ $user->id }})"
                                                    wire:confirm="Are you sure you want to restore {{ $user->full_name }}?"
                                                    icon="arrow-path"
                                                >
                                                    Restore
                                                </flux:menu.item>

                                                <flux:menu.item
                                                    wire:click="permanentlyDeleteUser({{ $user->id }})"
                                                    wire:confirm="Are you sure you want to permanently delete {{ $user->full_name }}? This action cannot be undone!"
                                                    icon="trash"
                                                    variant="danger"
                                                >
                                                    Delete Forever
                                                </flux:menu.item>
                                            @else
                                                <!-- Actions for active users -->
                                                <flux:menu.item
                                                    wire:click="openEditUserModal({{ $user->id }})"
                                                    icon="pencil"
                                                >
                                                    Edit
                                                </flux:menu.item>

                                                <flux:menu.item
                                                    wire:click="toggleUserStatus({{ $user->id }})"
                                                    wire:confirm="Are you sure you want to {{ $user->is_active ? 'deactivate' : 'activate' }} {{ $user->full_name }}?"
                                                    icon="{{ $user->is_active ? 'pause' : 'play' }}"
                                                >
                                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                                </flux:menu.item>

                                                @if($user->roles->count() > 0)
                                                    <flux:menu.separator />
                                                    @foreach($user->roles as $role)
                                                        <flux:menu.item
                                                            wire:click="removeRole({{ $user->id }}, '{{ $role->name }}')"
                                                            wire:confirm="Are you sure you want to remove the '{{ $role->name }}' role from {{ $user->full_name }}?"
                                                            icon="minus"
                                                        >
                                                            Remove {{ $role->name }}
                                                        </flux:menu.item>
                                                    @endforeach
                                                @endif

                                                <flux:menu.separator />
                                                <flux:menu.item
                                                    wire:click="deleteUser({{ $user->id }})"
                                                    wire:confirm="Are you sure you want to delete {{ $user->full_name }}? This action can be undone from the deleted users view."
                                                    icon="trash"
                                                    variant="danger"
                                                >
                                                    Delete
                                                </flux:menu.item>
                                            @endif
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Role Distribution Chart -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <flux:heading size="lg" class="mb-4">Role Distribution</flux:heading>
            
            <div class="flex flex-col lg:flex-row items-center gap-6">
                <div class="w-full lg:w-1/2 h-64">
                    <canvas id="roleChart" wire:ignore></canvas>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($roles as $role)
                            <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full" style="background-color: {{ 
                                        $role->name === 'Super Admin' ? '#ef4444' : (
                                        $role->name === 'Admin' ? '#3b82f6' : (
                                        $role->name === 'User' ? '#10b981' : (
                                        $role->name === 'Guest' ? '#8b5cf6' : '#6b7280')))
                                    }}"></div>
                                    <flux:heading size="sm">{{ $role->name }}</flux:heading>
                                </div>
                                <div class="text-sm font-medium text-zinc-600 dark:text-zinc-400">
                                    {{ $role->users_count }} user{{ $role->users_count !== 1 ? 's' : '' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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

                    <flux:field>
                        <flux:label>Status</flux:label>
                        <flux:checkbox wire:model="isActive">
                            Active User
                        </flux:checkbox>
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

    @script
    <script>
        let roleChart = null;

        function initRoleChart() {
            const canvas = document.getElementById('roleChart');
            if (!canvas) return;

            // Wait for Chart to be available
            if (typeof window.Chart === 'undefined') {
                setTimeout(() => initRoleChart(), 100);
                return;
            }

            // Destroy existing chart
            if (roleChart) {
                roleChart.destroy();
                roleChart = null;
            }

            const chartData = @json($this->roleChartData);
            
            roleChart = new window.Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: chartData.colors,
                        borderWidth: 0,
                        hoverBorderWidth: 2,
                        hoverBorderColor: '#374151'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return `${label}: ${value} users (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateRotate: true,
                        duration: 1000
                    }
                }
            });
        }

        // Listen for Livewire events
        $wire.on('refreshChart', () => {
            setTimeout(() => initRoleChart(), 100);
        });

        // Initialize chart when component loads
        setTimeout(() => initRoleChart(), 500);
    </script>
    @endscript
</section>
