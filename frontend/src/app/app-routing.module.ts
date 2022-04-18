import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClientGuard } from './guards/client.guard';

const routes: Routes = [
  { path: '', canActivate: [ClientGuard], loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule) },
  { path: 'login', loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule) },
  { path: 'register', loadChildren: () => import('./pages/register/register.module').then(m => m.RegisterModule) },
  { path: 'profiles', canActivate: [ClientGuard], loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule) },
  { path: 'admin/users', canActivate: [ClientGuard], loadChildren: () => import('./pages/admin/users/users.module').then(m => m.UsersModule) },
  { path: 'admin/addnew', canActivate: [ClientGuard], loadChildren: () => import('./pages/admin/addnew/addnew.module').then(m => m.AddnewModule) },
  { path: 'home', canActivate: [ClientGuard], loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule) },
  { path: 'edit-create-profile', loadChildren: () => import('./pages/edit-create-profile/edit-create-profile.module').then(m => m.EditCreateProfileModule) },
  { path: 'edit-create-profile/:id', loadChildren: () => import('./pages/edit-create-profile/edit-create-profile.module').then(m => m.EditCreateProfileModule) }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
