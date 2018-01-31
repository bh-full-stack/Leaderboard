import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RegistrationComponent } from './components/registration/registration.component';
import { ActivationComponent } from './components/activation/activation.component';
import { LoginComponent } from './components/login/login.component';

const routes: Routes = [
  {path: 'registration', component: RegistrationComponent},
  {path: 'activation/:activation_code', component: ActivationComponent},
  {path: 'login', component: LoginComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PlayerRoutingModule { }
