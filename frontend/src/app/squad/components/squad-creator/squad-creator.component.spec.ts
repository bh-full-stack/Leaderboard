import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SquadCreatorComponent } from './squad-creator.component';

describe('SquadCreatorComponent', () => {
  let component: SquadCreatorComponent;
  let fixture: ComponentFixture<SquadCreatorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SquadCreatorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SquadCreatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
