USE [master]
GO
/****** Object:  Database [alsahelDb]    Script Date: 5/21/2022 10:23:22 AM ******/
CREATE DATABASE [alsahelDb]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'alsahelDb', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\alsahelDb.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'alsahelDb_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\alsahelDb_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [alsahelDb] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [alsahelDb].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [alsahelDb] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [alsahelDb] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [alsahelDb] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [alsahelDb] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [alsahelDb] SET ARITHABORT OFF 
GO
ALTER DATABASE [alsahelDb] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [alsahelDb] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [alsahelDb] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [alsahelDb] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [alsahelDb] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [alsahelDb] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [alsahelDb] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [alsahelDb] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [alsahelDb] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [alsahelDb] SET  DISABLE_BROKER 
GO
ALTER DATABASE [alsahelDb] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [alsahelDb] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [alsahelDb] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [alsahelDb] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [alsahelDb] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [alsahelDb] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [alsahelDb] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [alsahelDb] SET RECOVERY FULL 
GO
ALTER DATABASE [alsahelDb] SET  MULTI_USER 
GO
ALTER DATABASE [alsahelDb] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [alsahelDb] SET DB_CHAINING OFF 
GO
ALTER DATABASE [alsahelDb] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [alsahelDb] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [alsahelDb] SET DELAYED_DURABILITY = DISABLED 
GO
USE [alsahelDb]
GO
/****** Object:  User [maraim]    Script Date: 5/21/2022 10:23:22 AM ******/
CREATE USER [maraim] FOR LOGIN [maraim] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  User [admin]    Script Date: 5/21/2022 10:23:22 AM ******/
CREATE USER [admin] FOR LOGIN [admin] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [maraim]
GO
ALTER ROLE [db_accessadmin] ADD MEMBER [maraim]
GO
/****** Object:  Table [dbo].[degree]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[degree](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[degree_name] [nvarchar](255) NOT NULL,
	[state] [int] NOT NULL CONSTRAINT [DF_degree_state]  DEFAULT ((1)),
 CONSTRAINT [PK_degree] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[department]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[department](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[dep_name] [nvarchar](255) NOT NULL,
	[state] [int] NOT NULL CONSTRAINT [DF_department_state]  DEFAULT ((1)),
 CONSTRAINT [PK_department] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[emp_salaries]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[emp_salaries](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[emp_id] [int] NOT NULL,
	[salary_value] [float] NOT NULL,
	[emp_identity] [nvarchar](255) NOT NULL,
	[emp_degree] [int] NOT NULL,
	[emp_dep] [nvarchar](255) NOT NULL,
 CONSTRAINT [PK_emp_salaries] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[emploies]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[emploies](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[emp_id] [int] NOT NULL,
	[emp_name] [nvarchar](255) NOT NULL,
	[emp_father_name] [nvarchar](255) NOT NULL,
	[emp_sur_name] [nvarchar](255) NOT NULL,
	[birth_date] [date] NOT NULL,
	[inserting_date] [date] NOT NULL CONSTRAINT [DF_employies_inserting_date]  DEFAULT (getdate()),
	[state] [bit] NOT NULL CONSTRAINT [DF_employies_state]  DEFAULT ((1)),
 CONSTRAINT [PK_employies] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[employee_events]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[employee_events](
	[event_id] [int] IDENTITY(1,1) NOT NULL,
	[emp_id] [int] NOT NULL,
	[event_type] [int] NOT NULL,
	[value] [float] NOT NULL,
	[event_date] [datetime] NOT NULL CONSTRAINT [DF_employee_events_event_date]  DEFAULT (getdate()),
	[state] [int] NOT NULL DEFAULT ((1)),
 CONSTRAINT [PK_employee_events] PRIMARY KEY CLUSTERED 
(
	[event_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[identity]    Script Date: 5/21/2022 10:23:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[identity](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[identity_name] [nvarchar](255) NOT NULL,
	[state] [int] NOT NULL CONSTRAINT [DF_identity_state]  DEFAULT ((1)),
 CONSTRAINT [PK_identity] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[degree] ON 

INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (1, N'الاولي', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (2, N'التانية', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (3, N'التالته', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (4, N'الرابعة', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (5, N'الخامسة', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (6, N'السادسة', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (7, N'السابعة', 1)
INSERT [dbo].[degree] ([id], [degree_name], [state]) VALUES (8, N'التامنة', 1)
SET IDENTITY_INSERT [dbo].[degree] OFF
SET IDENTITY_INSERT [dbo].[department] ON 

INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (1, N'الشبكات', 1)
INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (2, N'صيانة حاسبات', 1)
INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (3, N'أرشيف', 1)
INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (4, N'إدخال بيانات', 1)
INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (5, N'قانون', 1)
INSERT [dbo].[department] ([id], [dep_name], [state]) VALUES (6, N'محاسبة', 1)
SET IDENTITY_INSERT [dbo].[department] OFF
SET IDENTITY_INSERT [dbo].[emp_salaries] ON 

INSERT [dbo].[emp_salaries] ([id], [emp_id], [salary_value], [emp_identity], [emp_degree], [emp_dep]) VALUES (1, 111, 2600, N'2', 8, N'6')
INSERT [dbo].[emp_salaries] ([id], [emp_id], [salary_value], [emp_identity], [emp_degree], [emp_dep]) VALUES (2, 222, 5000, N'1', 8, N'2')
INSERT [dbo].[emp_salaries] ([id], [emp_id], [salary_value], [emp_identity], [emp_degree], [emp_dep]) VALUES (3, 333, 5000, N'1', 8, N'2')
INSERT [dbo].[emp_salaries] ([id], [emp_id], [salary_value], [emp_identity], [emp_degree], [emp_dep]) VALUES (6, 444, 6000, N'1', 1, N'1')
SET IDENTITY_INSERT [dbo].[emp_salaries] OFF
SET IDENTITY_INSERT [dbo].[emploies] ON 

INSERT [dbo].[emploies] ([id], [emp_id], [emp_name], [emp_father_name], [emp_sur_name], [birth_date], [inserting_date], [state]) VALUES (1, 111, N'محمد', N'عبد الرحمن', N'الغرياني', CAST(N'1994-08-16' AS Date), CAST(N'2022-01-31' AS Date), 0)
INSERT [dbo].[emploies] ([id], [emp_id], [emp_name], [emp_father_name], [emp_sur_name], [birth_date], [inserting_date], [state]) VALUES (2, 222, N'عبد الرحمن', N'محمد', N'الصرماني', CAST(N'1987-03-25' AS Date), CAST(N'2022-01-31' AS Date), 1)
INSERT [dbo].[emploies] ([id], [emp_id], [emp_name], [emp_father_name], [emp_sur_name], [birth_date], [inserting_date], [state]) VALUES (3, 333, N'مروة', N'عبد الرزاق', N'التاورغي', CAST(N'1987-03-25' AS Date), CAST(N'2022-01-31' AS Date), 1)
INSERT [dbo].[emploies] ([id], [emp_id], [emp_name], [emp_father_name], [emp_sur_name], [birth_date], [inserting_date], [state]) VALUES (6, 444, N'هدي', N'عبد الحكيم', N'الورفلي', CAST(N'1975-02-28' AS Date), CAST(N'2022-01-31' AS Date), 1)
SET IDENTITY_INSERT [dbo].[emploies] OFF
SET IDENTITY_INSERT [dbo].[employee_events] ON 

INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (1, 111, 2, 100, CAST(N'2022-01-31 00:00:00.000' AS DateTime), 1)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (2, 111, 1, 150, CAST(N'2022-01-31 00:00:00.000' AS DateTime), 1)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (3, 111, 3, 200, CAST(N'2022-01-30 00:00:00.000' AS DateTime), 1)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (4, 111, 3, 250, CAST(N'2022-01-31 00:00:00.000' AS DateTime), 1)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (5, 222, 3, 1000, CAST(N'2022-01-31 00:00:00.000' AS DateTime), 1)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (6, 111, 2, 50, CAST(N'2022-02-01 00:00:00.000' AS DateTime), 0)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (7, 444, 3, 8000, CAST(N'2022-02-01 00:00:00.000' AS DateTime), 0)
INSERT [dbo].[employee_events] ([event_id], [emp_id], [event_type], [value], [event_date], [state]) VALUES (8, 222, 2, 200, CAST(N'2022-05-12 00:00:00.000' AS DateTime), 0)
SET IDENTITY_INSERT [dbo].[employee_events] OFF
SET IDENTITY_INSERT [dbo].[identity] ON 

INSERT [dbo].[identity] ([id], [identity_name], [state]) VALUES (1, N'موظف', 1)
INSERT [dbo].[identity] ([id], [identity_name], [state]) VALUES (2, N'رئيس قسم', 1)
INSERT [dbo].[identity] ([id], [identity_name], [state]) VALUES (3, N'مدير', 1)
INSERT [dbo].[identity] ([id], [identity_name], [state]) VALUES (4, N'مدير عام', 1)
SET IDENTITY_INSERT [dbo].[identity] OFF
/****** Object:  Index [NonClusteredIndex-20220131-170330]    Script Date: 5/21/2022 10:23:22 AM ******/
CREATE UNIQUE NONCLUSTERED INDEX [NonClusteredIndex-20220131-170330] ON [dbo].[emp_salaries]
(
	[emp_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
USE [master]
GO
ALTER DATABASE [alsahelDb] SET  READ_WRITE 
GO
