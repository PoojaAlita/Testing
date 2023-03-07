<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif
                                    
    <form method="post" id="profile_update" class="mt-6 space-y-6 profile_update">
        @csrf
        @method('patch')
        <input type="hidden" id='id' name='id' value="{{$user->id}}">
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">Name</label>
            <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full input-line-height input-custom" id="name" name="name" type="text" value="{{$user->name}}"  autofocus="autofocus" autocomplete="name" name="name">
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">Email</label>
            <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full input-line-height input-custom" id="email" name="email" type="email" value="{{$user->email}}"  autocomplete="username" name="email">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save
          </button>
        </div>
    </form>
</section>

