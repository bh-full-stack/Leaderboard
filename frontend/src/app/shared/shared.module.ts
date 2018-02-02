import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';

import { ApiService } from './services/api.service';
import { AuthService } from './services/auth.service';
import { NavigationComponent } from './components/navigation/navigation.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { TinyEditorComponent } from './components/tiny-editor/tiny-editor.component';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    RouterModule
  ],
  declarations: [NavigationComponent, NotFoundComponent, TinyEditorComponent],
  providers: [AuthService],
  exports: [
    NavigationComponent,
    TinyEditorComponent
  ]
})
export class SharedModule { }
