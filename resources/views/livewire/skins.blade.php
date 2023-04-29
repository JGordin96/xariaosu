<div>
    <div class="navbar navbar-light bg-light" x-data="{showSkinOptions : false}">
        <div class="dropdown">
            <button 
                class="btn btn-secondary"
                type="button" 
                id="dropdownMenuButton"
                x-on:click="showSkinOptions = !showSkinOptions"
            >
              Skins
            </button>
            <div x-show="showSkinOptions" x-data="{showSkinUploader : false}">
                <select wire:model="selectedSkin">
                    @foreach($skins as $skin)
                        <option value="{{$skin}}">{{ $skin }}</option>
                    @endforeach
                </select>
    
                <span x-on:click="showSkinUploader = !showSkinUploader" class="badge bg-success text-light" rel="tooltip" title="Add Skin">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
    
                <div x-show="showSkinUploader">
                    {{-- <form wire:submit.prevent="save">
                        <input type="file" webkitdirectory directory multiple wire:model="photos">
                     
                        <button type="submit">Save Photo</button>
                    </form> --}}
                    {{-- <div>
                        <div class="form-group">
                          <label for="name">Skin Name</label>
                          <input type="text" class="form-control" id="name" name="name" wire:model="skin.name">

                            <label class="form-label" for="customFile">Skin File</label>
                            <input type="file" accept="image/*" class="form-control" id="customFile" name="skinFolder" wire:model="skin.customFile">
                        </div>
                        <button wire:click="UploadSkin" type="submit" class="btn btn-primary mb-2">Upload Skin</button>
                    </div> --}}
                </div>
            </div>
          </div>
    </div>
</div>

