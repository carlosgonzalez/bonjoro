export interface TodoDetails {
  id: string;
  recipient: string;
  title: string;
  created_at: string;
  video_watched: boolean;
  video_name: string;
  status: TodoStatus;
}

export enum TodoStatus {
  completed = "Completed",
  not_completed = "Not Completed"
}

export interface Response {
  code?: number;
  message?: string;
} 

export type TodoItem = Pick<TodoDetails, 'id' | 'recipient' | 'status'>;

export type TodoListResponse = Record<'data', TodoDetails[]>;

export type AddTodoRequest = Pick<TodoDetails, 'title' | 'recipient'>;

export interface SingleTodoResponse extends Response{
  data: TodoDetails;
} 

export interface DeleteTodoResponse {
  'success': boolean
}

export type UpdateTodoRequest = Partial<TodoDetails>;
