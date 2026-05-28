import React from 'react';
import { QueryClient, QueryClientProvider } from 'react-query';
import { ReactQueryDevtools } from 'react-query/devtools';
import { HashRouter } from 'react-router-dom';
import { Header } from './components/Header';
import Router from './router/Router';

const Dashboard: React.FC = () => {
	return (
		<HashRouter>
			<QueryClientProvider
				client={
					new QueryClient({
						defaultOptions: {
							queries: {
								refetchOnWindowFocus: false,
								refetchOnReconnect: false,
								useErrorBoundary: true,
								retry: false,
							},
						},
					})
				}
			>
				<Header />
				<div className="container mx-auto lg:max-w-screen-xl px-5 box-border">
					<Router />
				</div>
				<ReactQueryDevtools initialIsOpen={false} />
			</QueryClientProvider>
		</HashRouter>
	);
};

export default Dashboard;
