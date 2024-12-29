<form method="POST" action="{{ $action }}">
    @csrf

    <div class="form-group">
        <label for="content">感想</label>
        <textarea id="content" name="content" class="form-control" rows="3" placeholder="Write your post here">{{ old('content', $micropost->content ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="practice_date">練習日時</label>
        <input type="datetime-local" id="practice_date" name="practice_date" class="form-control" value="{{ old('practice_date', $micropost->practice_date ?? '') }}">
    </div>
    
    <div class="form-group">
        <label for="distance">走行距離</label>
        <input type="number" step="0.1" id="distance" name="distance" class="form-control" value="{{ old('distance', $micropost->distance ?? '') }}">
    </div>
    
    <div class="form-group">
        <label for="pace">ペース</label>
        <input type="number" step="0.1" id="pace" name="pace" class="form-control" value="{{ old('pace', $micropost->pace ?? '') }}">
    </div>
    
    <div class="form-group">
        <label for="time">時間</label>
        <input type="number" step="0.1" id="time" name="time" class="form-control" value="{{ old('time', $micropost->time ?? '') }}">
    </div>
    
    <div class="form-group">
        <label for="heart_rate_level">心拍レベル</label>
        <input type="number" id="heart_rate_level" name="heart_rate_level" class="form-control" value="{{ old('heart_rate_level', $micropost->heart_rate_level ?? '') }}">
    </div>
    
    <div class="form-group">
        <label for="sport_type">スポーツのタイプ</label>
        <input type="text" id="sport_type" name="sport_type" class="form-control" value="{{ old('sport_type', $micropost->sport_type ?? '') }}">
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-2">{{ $buttonText }}</button>
</form>