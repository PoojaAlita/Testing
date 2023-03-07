<section>
    <header>
        <h2 class="font-medium text-gray-900 ">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>
    
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 password_update">
        @csrf
        @method('put')
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="current_password">Current Password</label>
            <input class="border-gray-300  dark:text-gray-300   rounded-md shadow-sm mt-1 block w-full input-line-height input-custom" id="current_password" name="current_password" type="password" autocomplete="current-password">
        </div>
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="password">New Password</label>
            <input class="border-gray-300  dark:text-gray-300  rounded-md shadow-sm mt-1 block w-full input-line-height input-custom" id="password" name="password" type="password" autocomplete="new-password">
        </div>
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="password_confirmation">Confirm Password</label>
            <input class="border-gray-300 dark:text-gray-300   rounded-md shadow-sm mt-1 block w-full input-line-height input-custom" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase  ease-in-out duration-150">Save
            </button>
        </div>
    </form>
</section>
