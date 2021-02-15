<label class="switch switch-3d switch-success mr-3">
    <input type="checkbox" value="{{ !empty($data) && $data->active == \MyCore\Core\Models\User::STATUS_ACTIVE ? 0 : 1  }}" 
    class="switch-input toggle-active" 
    data-id="{{ $data->id }}" {{ !empty($data) && $data->active == \MyCore\Core\Models\User::STATUS_ACTIVE ? 'checked' : '' }}> 
    <span class="switch-label"></span> 
    <span class="switch-handle"></span>
</label>