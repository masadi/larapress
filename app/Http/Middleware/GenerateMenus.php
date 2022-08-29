<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        \Menu::make('NavbarUtama', function ($m) {
            $menus = [
                [
                    'name' => 'Beranda',
                    'url'=> url('/'),
                ],
                [
                    'name' => 'Fitur',
                    'url'=> '#fitur',
                ],
                [
                    'name' => 'Harga',
                    'url'=> '#harga',
                ],
                [
                    'name' => 'Klien',
                    'url'=> '#klien',
                ],
                [
                    'name' => 'FAQ',
                    'url'=> '#faq',
                ],
                [
                    'name' => 'Kontak',
                    'url'=> '#kontak',
                ],
                [
                    'name' => 'Login',
                    'url'=> route('login'),
                    'loggedin' => (auth()->user()) ? true : false,
                ],
                [
                    'name' => 'Dashboard',
                    'url'=> route('dashboard'),
                    'loggedin' => (auth()->user()) ? false : true,
                ],
            ];
            foreach($menus as $menu){
                $array = ['url' => $menu['url'], 'class' => 'nav-item'];
                $dropdown = '';
                if(isset($menu['submenu'])){
                    $dropdown = ' dropdown-toggle';
                    $array = ['url' => $menu['url'], 'class' => 'nav-item dropdown'];
                }
                $loggedin = NULL;
                if(isset($menu['loggedin'])){
                    $dropdown = $dropdown.' getstarted';
                    $loggedin = $menu['loggedin'];
                }
                $m->add($menu['name'], $array)
                ->data(['loggedin' => $loggedin])
                ->append('</span>')
                ->prepend('<span>')
                ->link->attr([
                    'class'         => 'nav-link d-flex align-items-center'.$dropdown,
                ]);
                if(isset($menu['submenu'])){
                    $this->submenus($menu['submenu'], $menu, $m);
                }
            }
        })->filter(function($item){
            if($item->data('loggedin')){
                return false;
            } else {
                return true;
            }
        });
        \Menu::make('MyNavBar', function ($m) {
            $menus = [
                [
                    'name' => 'Home',
                    'url' => 'dashboard',
                    'icon' => '<i class="fa-solid fa-house"></i>',
                    'roles' => '',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Nomor Whatsapp',
                    'url' => 'nomor-whatsapp',
                    'icon' => '<i class="fa-brands fa-whatsapp"></i>',
                    'roles' => '',
                    'active' => 'nomor-whatsapp/*',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Campaign',
                    'url' => 'campaign-message',
                    'icon' => '<i class="fa-solid fa-person-running"></i>',
                    'roles' => '',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Auto Reply',
                    'url'  => 'auto-reply',
                    'icon' => '<i class="fa-solid fa-headset"></i>',
                    'roles'	=> '',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Lelang',
                    'url'  => 'lelang',
                    'icon' => '<i class="fa-solid fa-person-chalkboard"></i>',
                    'roles'	=> '',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Data Pengguna',
                    'url'  => 'users',
                    'icon' => '<i class="fa-solid fa-people-line"></i>',
                    'roles'	=> 'administrator',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Profil Pengguna',
                    'url'  => 'user/profile',
                    'icon' => '<i class="fa-solid fa-user"></i>',
                    'roles'	=> '',
                    'attr' => $this->text_class(),
                ],
                [
                    'name' => 'Keluar Aplikasi',
                    'url'  => 'logout',
                    'icon' => '<i class="fa-solid fa-power-off"></i>',
                    'roles'	=> '',
                    'attr' => $this->text_class('danger', 'event.preventDefault(); document.getElementById(\'logout-form\').submit();'),
                ],
            ];
            foreach($menus as $menu){
                if(isset($menu['badge'])){
                    $m->add($menu['name'], $menu['url'])
                    ->data(['roles' => $menu['roles']])
                    ->append($this->setAppend($menu['badge']->first(), $menu['badge']->last()))
                    ->prepend($this->icon($menu['icon']))
                    ->link->attr($menu['attr']);
                } else {
                    if(isset($menu['active'])){
                        $m->add($menu['name'], $menu['url'])->active($menu['active'])->data(['roles' => $menu['roles']])->append($this->setAppend())->prepend($this->icon($menu['icon']))->link->attr($menu['attr']);
                    } else {
                        $m->add($menu['name'], $menu['url'])->data(['roles' => $menu['roles']])->append($this->setAppend())->prepend($this->icon($menu['icon']))->link->attr($menu['attr']);
                    }
                }
                if(isset($menu['submenu'])){
                    foreach($menu['submenu'] as $submenu){
                        $this->submenu($submenu, $menu, $m);
                        if(isset($submenu['submenu'])){
                            foreach($submenu['submenu'] as $sub_submenu){
                                $this->submenu($sub_submenu, $submenu, $m);       
                            }
                        }
                    }
                }
            }
        })->filter(function($item){
            if(auth()->user()){
                if($item->data('roles')){
                    if(auth()->user()->hasRole( $item->data('roles'), session('tahun-ajaran'))) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            }
        });
        return $next($request);
    }
    private function icon($icon){
        return $icon.'<span class="menu-title text-truncate">';
    }
    private function text_class($color = NULL, $onclick = NULL){
        if($onclick){
            if($color){
                return [
                    'class' => 'd-flex align-items-center text-'.$color,
                    'onclick' => $onclick,
                    'title' => 'asd',
                ];
            } else {
                return [
                    'class' => 'd-flex align-items-center',
                    'onclick' => $onclick,
                ];
            }
        } else {
            if($color){
                return ['class' => 'd-flex align-items-center text-'.$color];
            } else {
                return [
                    'class' => 'd-flex align-items-center',
                ];
            }
        }
    }
    private function badge($color, $text){
        return '<span class="badge rounded-pill badge-light-'.$color.' ms-auto me-1">'.$text.'</span>';
    }
    private function setAppend($color = NULL, $text = NULL){
        if($color){
            return '</span>'.$this->badge($color, $text);
        } else {
            return '</span>';
        }
    }
    private function submenu($submenu, $menu, $m){
        if(isset($submenu['badge'])){
            $m->{Str::camel(Str::ascii($menu['name']))}->add($submenu['name'], $submenu['url'])->data(['roles' => $submenu['roles']])->append($this->setAppend($submenu['badge']->first(), $submenu['badge']->last()))->prepend($this->icon($submenu['icon']))->link->attr($submenu['attr']);
        } else {
            $m->{Str::camel(Str::ascii($menu['name']))}->add($submenu['name'], $submenu['url'])->data(['roles' => $submenu['roles']])->append($this->setAppend())->prepend($this->icon($submenu['icon']))->link->attr($submenu['attr']);
        }
    }
    private function submenus($menus, $parrent, $m){
        foreach($menus as $menu){
            $array = ['url' => $menu['url'], 'class' => 'nav-item'];
            $dropdown = '';
            if(isset($menu['submenu'])){
                $dropdown = ' dropdown-toggle';
                $array = ['url' => $menu['url'], 'class' => 'dropdown dropdown-submenu', 'data-menu' => 'dropdown-submenu'];
            }
            $m->{Str::camel(Str::ascii($parrent['name']))}->add($menu['name'], $array)
            ->append('</span>')
            ->prepend('<span>')
            ->link->attr([
                'class'         => 'dropdown-item d-flex align-items-center'.$dropdown,
                'data-bs-toggle' => ($dropdown) ? 'dropdown' : '',
            ]);
            if(isset($menu['submenu'])){
                $this->submenus($menu['submenu'], $menu, $m);
            }
        }
    }
}
