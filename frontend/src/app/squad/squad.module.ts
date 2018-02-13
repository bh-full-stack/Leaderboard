import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SquadRoutingModule } from './squad-routing.module';
import { SquadListComponent } from './components/squad-list/squad-list.component';
import { SquadCreatorComponent } from './components/squad-creator/squad-creator.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SquadService } from './services/squad.service';
import { ColorPickerModule } from 'ngx-color-picker';

@NgModule({
  imports: [
    CommonModule,
    SquadRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    ColorPickerModule
  ],
  declarations: [SquadListComponent, SquadCreatorComponent],
  providers: [
    SquadService
  ]
})
export class SquadModule { }
