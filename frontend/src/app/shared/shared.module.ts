import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';

import { NavigationComponent } from './components/navigation/navigation.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { TinyEditorComponent } from './components/tiny-editor/tiny-editor.component';
import { TrustHtmlPipe } from './pipes/trust-html.pipe';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    RouterModule
  ],
  declarations: [NavigationComponent, NotFoundComponent, TrustHtmlPipe, TinyEditorComponent],
  exports: [
    NavigationComponent,
    TrustHtmlPipe,
    TinyEditorComponent
  ]
})
export class SharedModule { }
