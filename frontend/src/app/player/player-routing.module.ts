import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegistrationComponent } from './components/registration/registration.component';
import { ActivationComponent } from './components/activation/activation.component';
import { LoginComponent } from './components/login/login.component';
import { ProfilePublicComponent } from './components/profile-public/profile-public.component';
import { ProfileAdminComponent } from './components/profile-admin/profile-admin.component';
import { PasswordChangerComponent } from './components/password-changer/password-changer.component';
import { PlayerDeleteComponent } from './components/player-delete/player-delete.component';

const routes: Routes = [
  {path: 'registration', component: RegistrationComponent},
  {path: 'activation/:activation_code', component: ActivationComponent},
  {path: 'login', component: LoginComponent},
  {path: 'profile/:player_id', component: ProfilePublicComponent},
  {path: 'profile/:player_id/edit', component: ProfileAdminComponent},
  {path: 'password-change', component: PasswordChangerComponent},
  {path: 'delete', component: PlayerDeleteComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PlayerRoutingModule { }
