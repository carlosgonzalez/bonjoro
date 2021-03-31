import React from "react";
import styled from 'styled-components';
import RootView from './views/RootView';
import { QueryClient, QueryClientProvider } from 'react-query'

const Container = styled.div`
  display: block;
`;

export default function App() {
  const queryClient = new QueryClient({
    defaultOptions: { 
      queries: {
        retry: (retryCount, error: any) => {
          if (error?.response.status === 404 || retryCount > 3) {
            return false;
          }
          return true;
        }
      }
    }
  });

  return (
    <QueryClientProvider client={queryClient}>
      <Container>
        <RootView/>
      </Container>
    </QueryClientProvider>
  );
}
