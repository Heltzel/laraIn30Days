<x-layout>
    <x-slot:heading>
        Show Job {{ $job['title'] }}
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
    <p>
        This job pays {{ $job['salary'] }} per year.
    </p>
    <div class="flex gap-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
        <form method="POST" action="/jobs/{{ $job->id }}">
            @csrf
            @method('DELETE')
            <x-button-delete>Delete</x-button-delete>
        </form>
    </div>

</x-layout>
