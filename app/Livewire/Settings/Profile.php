<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $first_name = '';

    public string $last_name = '';

    public string $username = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $birth_date = '';

    public string $gender = '';

    public $avatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->username = $user->username ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->birth_date = $user->birth_date ? $user->birth_date->format('Y-m-d') : '';
        $this->gender = $user->gender ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($this->avatar) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $this->avatar->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        } else {
            // Remove avatar from validated array if no new file uploaded
            // This prevents overwriting existing avatar with null
            unset($validated['avatar']);
        }

        // Convert empty strings to null for nullable fields
        if (empty($validated['phone'])) {
            $validated['phone'] = null;
        }
        if (empty($validated['address'])) {
            $validated['address'] = null;
        }
        if (empty($validated['birth_date'])) {
            $validated['birth_date'] = null;
        }
        if (empty($validated['gender'])) {
            $validated['gender'] = null;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->full_name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}
