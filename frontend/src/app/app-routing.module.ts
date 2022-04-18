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
    path: 'admin/addnew',
    canActivate: [AdminGuard],
    loadChildren: () => import('./pages/admin/addnew/addnew.module').then(m => m.AddnewModule)
  },
  {
    path: 'home',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule)
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
    path: 'movie-serie/:id',
    canActivate: [ClientGuard],
    loadChildren: () => import('./pages/movie-serie/movie-serie.module').then(m => m.MovieSerieModule)
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
