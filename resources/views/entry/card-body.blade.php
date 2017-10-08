<div class="card-body">
    <div class="form-group">
        <input type="text" class="form-control" name="working_with" value="{{ $entry->working_with }}" placeholder="Vad jobbar du med?">
    </div>
    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-dark border-dark" type="button">-0,25</button>
        </span>
        <input type="number" min="0" step="0.25" class="form-control text-center border-dark" value="{{ $entry->duration }}">
        <span class="input-group-btn">
            <button class="btn btn-dark border-dark" type="button">+0,25</button>
        </span>
    </div>
</div>