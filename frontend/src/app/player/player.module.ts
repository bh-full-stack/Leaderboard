import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FileUploadModule } from 'ng2-file-upload/file-upload/file-upload.module';

import { PlayerRoutingModule } from './player-routing.module';
import { RegistrationComponent } from './components/registration/registration.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PlayerService } from './services/player.service';
import { ActivationComponent } from './components/activation/activation.component';
import { LoginComponent } from './components/login/login.component';
import { ProfilePublicComponent } from './components/profile-public/profile-public.component';
import { SharedModule } from './../shared/shared.module';
import { ProfileAdminComponent } from './components/profile-admin/profile-admin.component';
import { OldScoresHandlerComponent } from './components/old-scores-handler/old-scores-handler.component';
import { PasswordChangerComponent } from './components/password-changer/password-changer.component';
import { PlayerDeleteComponent } from './components/player-delete/player-delete.component';

@NgModule({
  imports: [
    CommonModule,
    PlayerRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule,
    FileUploadModule
  ],
  declarations: [
    RegistrationComponent,
    ActivationComponent,
    LoginComponent,
    ProfilePublicComponent,
    ProfileAdminComponent,
    OldScoresHandlerComponent,
    PasswordChangerComponent,
    PlayerDeleteComponent
  ],
  providers: [PlayerService]
})
export class PlayerModule { }
