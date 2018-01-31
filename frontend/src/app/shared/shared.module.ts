import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';

import { NavigationComponent } from './components/navigation/navigation.component';
import { ApiService } from './services/api.service';
import { AuthService } from './services/auth.service';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    RouterModule
  ],
  declarations: [NavigationComponent, NotFoundComponent],
  providers: [AuthService],
  exports: [
    NavigationComponent
  ]
})
export class SharedModule { }
