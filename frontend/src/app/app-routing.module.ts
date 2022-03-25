import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClientGuard } from './guards/client.guard';

const routes: Routes = [
  { path: '', canActivate: [ClientGuard], loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule) },
  { path: 'login', loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule) },
  { path: 'register', loadChildren: () => import('./pages/register/register.module').then(m => m.RegisterModule) },
  { path: 'profiles', canActivate: [ClientGuard], loadChildren: () => import('./pages/profiles/profiles.module').then(m => m.ProfilesModule) },
  { path: 'home', canActivate: [ClientGuard], loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule) },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
