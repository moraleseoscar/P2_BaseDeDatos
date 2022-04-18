import {
  NgModule
} from '@angular/core';
import {
  RouterModule,
  Routes
} from '@angular/router';
import {
  AdminGuard
} from './guards/admin.guard';
import {
  ClientGuard
} from './guards/client.guard';

const routes: Routes = [{
    path: '',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule)
  },
  {
    path: 'register',
    loadChildren: () => import('./pages/register/register.module').then(m => m.RegisterModule)
  },
  {
    path: 'profiles',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule)
  },
  {
    path: 'admin/users',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/users/users.module').then(m => m.UsersModule)
  },
  {
    path: 'admin/film',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/addnew/addnew.module').then(m => m.AddnewModule)
  },
  {
    path: 'admin/film/:id',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/addnew/addnew.module').then(m => m.AddnewModule)
  },
  {
    path: 'home',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule)
  },
  {
    path: 'favs',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/favs/favs.module').then(m => m.FavsModule)
  },
  {
    path: 'edit-create-profile',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/edit-create-profile/edit-create-profile.module').then(m => m.EditCreateProfileModule)
  },
  {
    path: 'edit-create-profile/:id',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/edit-create-profile/edit-create-profile.module').then(m => m.EditCreateProfileModule)
  },
  {
    path: 'admin/actors',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/actors/actors.module').then(m => m.ActorsModule)
  },
  {
    path: 'admin/actor',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/actor/actor.module').then(m => m.ActorModule)
  },
  {
    path: 'admin/actor/:id',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/actor/actor.module').then(m => m.ActorModule)
  },
  { 
    path: 'admin/directors', 
    loadChildren: () => import('./pages/admin/directors/directors.module').then(m => m.DirectorsModule) 
  },
  { 
    path: 'admin/director', 
    loadChildren: () => import('./pages/admin/director/director.module').then(m => m.DirectorModule) 
  },
  { 
    path: 'admin/director/:id', 
    loadChildren: () => import('./pages/admin/director/director.module').then(m => m.DirectorModule) 
  },
  { 
    path: 'admin/films',
    loadChildren: () => import('./pages/admin/films/films.module').then(m => m.FilmsModule) 
  }

  ];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}