import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SquadRoutingModule } from './squad-routing.module';
import { SquadListComponent } from './components/squad-list/squad-list.component';
import { SquadCreatorComponent } from './components/squad-creator/squad-creator.component';

@NgModule({
  imports: [
    CommonModule,
    SquadRoutingModule
  ],
  declarations: [SquadListComponent, SquadCreatorComponent]
})
export class SquadModule { }
