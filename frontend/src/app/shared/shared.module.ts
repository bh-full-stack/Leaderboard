import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';

import { NavigationComponent } from './components/navigation/navigation.component';
import { ApiService } from './services/api.service';
import { AuthService } from './services/auth.service';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule
  ],
  declarations: [NavigationComponent],
  providers: [AuthService],
  exports: [
    NavigationComponent
  ]
})
export class SharedModule { }
