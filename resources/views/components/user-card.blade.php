@props(['user', 'width' => '150px', 'height' => '150px'])


<div class="col-md-3 mb-4">
    <div class="card">
        <div class="card-body">
            <img class="card-img-top rounded-circle" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="{{ $user->name }}のプロフィール写真" style="width: {{ $width }}; height: {{ $height }}; border-radius: 50%; object-fit: cover;">
            <div class="font-medium text-base text-gray-800">
                {{ $user->name }}
            </div>
        </div>
    </div>
</div>
