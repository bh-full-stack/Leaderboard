import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PlayerRoutingModule } from './player-routing.module';
import { RegistrationComponent } from './components/registration/registration.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PlayerService } from './services/player.service';
import { ActivationComponent } from './components/activation/activation.component';
import { LoginComponent } from './components/login/login.component';
import { ProfileComponent } from './components/profile/profile.component';
import { TinyEditorComponent } from './components/tiny-editor/tiny-editor.component';

@NgModule({
  imports: [
    CommonModule,
    PlayerRoutingModule,
    FormsModule,
    ReactiveFormsModule
  ],
  declarations: [RegistrationComponent, ActivationComponent, LoginComponent, ProfileComponent, TinyEditorComponent],
  providers: [PlayerService]
})
export class PlayerModule { }
