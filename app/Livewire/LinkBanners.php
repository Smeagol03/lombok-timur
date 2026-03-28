<?php

use App\Models\LinkBanner;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class LinkBanners extends Component
{
    use WithPagination;

    #[Computed]
    public function banners()
    {
        return LinkBanner::active()
            ->ordered()
            ->paginate(6);
    }

    public function render()
    {
        return view('livewire.link-banners');
    }
}
