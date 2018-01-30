import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { NavigationComponent } from './components/navigation/navigation.component';

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [NavigationComponent],
  exports: [
    NavigationComponent
  ]
})
export class SharedModule { }
